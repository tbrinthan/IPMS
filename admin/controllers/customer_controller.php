<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Controller : Customer
 * Functions :  addNewCustomer, displayCustomerDetails, displayNodeDetail, addNodeDetail, showNodeSSID,
 *              deleteAssignedNodeIP, deleteAlreadyAssignedNodeIP, displayNodeIpTable, showSubCatPerCategory,
 *              displayCategoryIPDetail,addCategoryIPDetail, displayCategoryIPTable, deleteAssignedCategoryIP,
 *              deleteAlreadyAssignedCategoryIP,addPrivateIPDetail,displayPvtIpTable,deleteAssignedPvtIP,
 *              ViewCustomer, addTempCustomer, saveTempCustomer, viewTempCustomer,deleteTempCustomer,
 *              displayEndDate,getNotifications
 *
 * Help:
 * * Add/ Remove IP addresses to Customers-> Customer details are fetched from another database
 * * Add/Remove temporary Customer allocation
 * *
 * DATE          USER        DETAILS
 * 08-Aug-12    Brinthan    addNewCustomer controller
 */
//08-Aug-12 Begin
//13-Aug-12     Brinthan    Node location ->ssid->show ipdetails
//14-Aug-12     Brinthan    Delete assinged node ip value to custoemr
//15-Aug-12     Brinthan    Category_IP table view and Private Ip adding
//16-Aug-12     Brinthan    Add temp custoemr details
class Customer_Controller extends CI_Controller {

    function Customer_Controller() {
        parent::__construct();
        $this->load->model('customer_model');
        $this->load->library('pagination');
    }

//Controller -> Add New Customer
    function addNewCustomer($id = 0, $iid = 0) {
        if ($this->session->userdata('Logged_In')) {
            $data['title'] = "Add New Customer";
            $data['customers'] = $this->customer_model->getCustomerDetails();
            $data['crm_customers'] = $this->customer_model->getCustomerDetails_crm();
            $data['node_sub_cat'] = $this->customer_model->getNodeSubCategory();
            $data['locations'] = $this->customer_model->getLocations();
            $data['categories'] = $this->customer_model->getCategories();
            $data['custid'] = $id;
            $data['linkid'] = $iid;
            $partials = array('content' => 'customers/add_customer');
//            $this->customer_model->setSubCatID(3);
//            print_r($this->customer_model->getNodeIPDetailsBySubCatID());
//return;
            $this->template->load('template/simpla_template', $partials, $data);
        }
        else
            $this->load->view('login/login');
    }

//Display CUstomer Details -> when selected from drop down list
//Function is editted in order to access crm customers   
    function displayCustomerDetails() {

        if ($this->session->userdata('Logged_In')) {
            if (!isset($_SERVER['HTTP_X_REQUESTED_WITH'])) {
                redirect('customer_controller/addNewCustomer');
            } else {
                $linkid = $this->input->post('linkid');
                $this->customer_model->setCustomerID($this->input->post('cust_id'));
                $result = $this->customer_model->getCustomerDetailsByID();
                $enddate = $this->customer_model->getEndDateperID();
                //For customers with links
                $result1 = $this->customer_model->getCustomerLinksbyID();
                //For customers without links
                $result2 = $this->customer_model->getCustomerServicebyID();
                if ((!empty($result1) || !empty($result2)) && empty($enddate)) {
                    echo "<b>Links/Service&nbsp;&nbsp;&nbsp;: &nbsp;&nbsp;   </b>";
                    echo "<select id=\"LinkService\" onchange=\"get_LinkServiceDetails(this.value)\"><option value=\"0\">Select Links/Service</option>";
                    if (!empty($result1)) {
                        foreach ($result1 as $row) {
                            if ($row->id == $linkid)
                                echo "<option style=\"padding-bottom: 1Px;padding-top: 1Px;\"  value=\"" . $row->id . "\" selected=\"selected\">Links(" . $row->serialno. ")--" . $row->linkname . "</option>";
                            else
                                echo "<option style=\"padding-bottom: 1Px;padding-top: 1Px;\"  value=\"" . $row->id . "\">Links(" . $row->serialno . ")--" . $row->linkname . "</option>";
                        }
                    }
                    if (!empty($result2)) {
                        foreach ($result2 as $row) {
                            if ($row->id == $linkid)
                                echo "<option style=\"padding-bottom: 1Px;padding-top: 1Px;\"  value=\"" . $row->id . "\" selected=\"selected\">";
                            else
                                echo "<option style=\"padding-bottom: 1Px;padding-top: 1Px;\"  value=\"" . $row->id . "\">";
                            if (strtolower($row->identify) == "none" || $row->identify == "")
                                echo $row->service_name . "</option>";
                            else
                                echo $row->service_name . "--" . $row->identify . "</option>";
                        }
                    }

                    echo "</select>";
                }

                if (empty($result1) && empty($result2) && empty($result))
                    echo '<p style="font-size: 1.2em;font-family: sans-serif;font-variant: small-caps">No Services to Display.</p>';
//                foreach($result as $row){
//                    echo $row->customer_id."||".$row->bandwidth."||".$row->address."||". $row->connection_name;
//                }
                
                if(!empty($result) && !empty($enddate)){
                   foreach ($result as $row){
                            if($row->end_date != NULL && ($row->status==(NULL || 0))){ 
                    ?>

                <p id="custID" ><b> Customer ID&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: &nbsp;&nbsp; </b><b>
                    <span id="display_custID"><?php echo $row->customer_id;?></span></b>
                </p>
                <p id="custEndDate" ><b>
                End Date&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;
                    <span id="display_EndDate"><?php echo $enddate['end_date'];?></span></b>
                </p>
                <p id="custConnection" ><b> Connection Type&nbsp;&nbsp;: &nbsp;&nbsp; </b>
                    <b> <span id="display_custCon"><?php echo $row->connection_name;?></span>
                </p></b>
                <p id="custBW" ><b> BandWidth&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: &nbsp;&nbsp; </b>
                    <b> <span id="display_custBW"><?php echo $row->bandwidth;?></span>
                </p></b>
                <p id="custAddress" ><b> Address&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: &nbsp;&nbsp; </b>
                    <b> <span id="display_custAddress"><?php echo $row->address;?></span><br><br><br>

                        <input class="button" id="remove_temp_cust" type="button" value="Remove Temp Customer" style="display:block; height: 40px; font-variant:small-caps;float:left;margin-right: 50px " onclick="remove_Temp_Customer()"/>
                        <input class="button" id="edit_temp_cust" type="button" value="Edit Temp Customer" style="display:block; height: 40px; font-variant:small-caps; " onclick="edit_Temp_Customer()"/>

                </p></b>
                <?php }
            }
        }}}
        else
            $this->load->view('login/login');
    }

//08-Aug-12 End
//09-Aug-12 :Begin
//displayNodeDetail -> Show the node ip addresses allocation to Location->ssid wise.
    function displayNodeDetail($offset = 0) {
        if ($this->session->userdata('Logged_In')) {
            if (!isset($_SERVER['HTTP_X_REQUESTED_WITH'])) {
                redirect('customer_controller/addNewCustomer');
            } else {
                $sub_cat_id = $this->input->post('sub_cat_id');
                $this->customer_model->setSubCatID($sub_cat_id);
                $subcategory = $this->customer_model->getSubCategoryNameByID();

                $config['base_url'] = base_url() . 'index.php/customer_controller/displayNodeDetail/';
                $config['total_rows'] = count($this->customer_model->getNodeIPDetailsBySubCatID());
                $config['per_page'] = 10;

                $this->pagination->initialize($config);

                $jsFunction['name'] = 'get_NodeIPDetails_ForSSID_GET';
                $jsFunction['params'] = array($sub_cat_id);

                $this->pagination->initialize_js_function($jsFunction);

                $data['page_link'] = $this->pagination->create_js_links();
                $data['title'] = "Node Details of SSID [ " . $subcategory['location'] . " - " . $subcategory['ssid'] . " ]";
                $data['ssid_location'] = "[ " . $subcategory['location'] . " - " . $subcategory['ssid'] . " ]";
                $data['node_types'] = $this->customer_model->getNodeTypes();

                if ($this->customer_model->getNodeIPDetailsBySubCatID() == 0)
                    $this->load->view('customers/add_nodeIP_null', $data);
                else {
//                        $data['node_ip_details'] = $this->customer_model->getNodeIPDetailsBySubCatIDPage($config['per_page'],$offset);
                    $data['node_ip_details'] = $this->customer_model->getNodeIPDetailsBySubCatID();
                    $this->load->view('customers/add_nodeIPs_customer', $data);
                }
            }
        }
        else
            $this->load->view('login/login');
    }

//Assign Node Details to the Customer Id :-> get checked values and send back the checke node details
    function addNodeDetail() {
        if ($this->session->userdata('Logged_In')) {
            if (!isset($_SERVER['HTTP_X_REQUESTED_WITH'])) {
                redirect('customer_controller/addNewCustomer');
            } else {

                $checkedValues = $this->input->post('checked_values');
                $selectedValues = $this->input->post('selected_values');
                $customer_id = $this->input->post('customer');
                $custservid = $this->input->post('custservid');
                $arr = explode(',', trim($checkedValues));
                $arr1 = explode(',', trim($selectedValues));
                $arr = array_filter($arr);
                $arr1 = array_filter($arr1);
//                echo $custservid; return;
                $this->customer_model->setNodeDetailID($arr);
                $this->customer_model->setNodeTypeID($arr1);
                $this->customer_model->setCustomerID($customer_id);
                $this->customer_model->setCustservID($custservid);
//        echo $checkedValues."  ".$selectedValues."  ".$customer_id;
                $this->customer_model->getNodeDetailsByCustservID();
                $result = $this->customer_model->saveNodeDetailsByCustID();
                 echo $result;return;
                if ($result) {
//                    $data['assigned_nodeip_details'] = $this->customer_model->getNodeDetailsByCustomerID();
                    $data['assigned_nodeip_details'] = $this->customer_model->getNodeDetailsByCustservID();
                    $data['title'] = "Node IP Details";
                    $this->load->view('customers/assigned_nodeip_table', $data);
//                    echo '1';
                }

                else
                    echo'0';
            }
        }
        else
            $this->load->view('login/login');
    }

//09-Aug-12 :end
//13-Aug-12 :Begin
//Once the Node Location is selected->Show the Relevant SSIDs for the location
    function showNodeSSID() {
        if ($this->session->userdata('Logged_In')) {
            if (!isset($_SERVER['HTTP_X_REQUESTED_WITH'])) {
                redirect('customer_controller/addNewCustomer');
            } else {
                $this->customer_model->setLocationID($this->input->post('location_id'));
                $result = $this->customer_model->getSSIDByLocationID();
                echo "<option value=\"0\">Select Node SSID</option>";
                foreach ($result as $row) {
                    echo "<option style=\"padding-bottom: 1Px;padding-top: 1Px;\"  value=\"" . $row->sub_category_id . "\">" . $row->ssid . "</option>";
                }
            }
        }
        else
            $this->load->view('login/login');
    }

//13-Aug-12 :End
    //14-Aug-12:begin
    //Delete Immediately Assigned Node IP Addresses to the Customers
    function deleteAssignedNodeIP() {
        if ($this->session->userdata('Logged_In')) {
            if (!isset($_SERVER['HTTP_X_REQUESTED_WITH'])) {
                redirect('customer_controller/addNewCustomer');
            } else {
                $this->customer_model->setNodeDetailID($this->input->post('nodedetail_id'));
                if ($this->customer_model->clearAssignedNodeIPToCustomer()) {
                    echo '1';
                }
                else
                    echo '0';
            }
        }
        else
            $this->load->view('login/login');
    }

//Delete Node iP which was assigned previously to the customers
//    function deleteAlreadyAssignedNodeIP() {
//        if ($this->session->userdata('Logged_In')) {
//            if (!isset($_SERVER['HTTP_X_REQUESTED_WITH'])) {
//                redirect('customer_controller/addNewCustomer');
//            } else {
//                $this->customer_model->setNodeDetailID($this->input->post('nodedetail_id'));
//                if ($this->customer_model->clearAlreadyAssignedNodeIPToCustomer()) {
//                    echo '1';
//                }
//                else
//                    echo '0';
//            }
//        }
//        else
//            $this->load->view('login/login');
//    }
    
    function deleteAlreadyAssignedNodeIP(){
        if($this->session->userdata('Logged_In')){
            if (!isset($_SERVER['HTTP_X_REQUESTED_WITH']))
            {
                redirect('customer_controller/addNewCustomer');
            }
            else{
                $this->customer_model->setNodeDetailID($this->input->post('nodedetail_id'));
                $this->customer_model->setRemark($this->input->post('remark'));
                if($this->customer_model->clearAlreadyAssignedNodeIPToCustomer()){
                    echo '1';
                }
                else echo '0';
            }
        }
        else $this->load->view('login/login');
    }

//Display Assigned Node IPs table
    function displayNodeIpTable() {
        if ($this->session->userdata('Logged_In')) {
            if (!isset($_SERVER['HTTP_X_REQUESTED_WITH'])) {
                redirect('customer_controller/addNewCustomer');
            } else {
                $id=$this->input->post('custservid');
                $custid=$this->input->post('cust_id');
                $enddate=$this->input->post('enddate');
                if($id !=0){
//                $this->customer_model->setCustomerID($this->input->post('cust_id'));
                $this->customer_model->setCustservID($this->input->post('custservid'));
//                $data['assigned_nodeip_details'] = $this->customer_model->getNodeDetailsByCustomerID();
                $data['assigned_nodeip_details'] = $this->customer_model->getNodeDetailsByCustservID();
                $data['title'] = "Node IP Details";
                $this->load->view('customers/assigned_nodeip_table', $data);
                
                }
                else if($id==0){
                $this->customer_model->setCustomerID($this->input->post('cust_id'));
                $data['assigned_nodeip_details'] = $this->customer_model->getNodeDetailsByCustomerIDD();
                $data['title'] = "Node IP Details";
                $this->load->view('customers/assigned_nodeip_table_1', $data);
                }
                if($enddate !=0){
                $this->customer_model->setCustomerID($this->input->post('cust_id'));
                $data['assigned_nodeip_details'] = $this->customer_model->getNodeDetailsByCustomerID();
                $data['title'] = "Node IP Details";
                $this->load->view('customers/assigned_nodeip_table', $data);
                }
            }
        }
        else
            $this->load->view('login/login');
    }

    //14-Aug-12:end
    //15-Aug-12:Begin
//Once the Node Location is selected->Show the Relevant SSIDs for the location
    function showSubCatPerCategory() {
        if ($this->session->userdata('Logged_In')) {
            if (!isset($_SERVER['HTTP_X_REQUESTED_WITH'])) {
                redirect('customer_controller/addNewCustomer');
            } else {
                $this->customer_model->setCategoryID($this->input->post('cat_id'));
                $result = $this->customer_model->getSubCatByCategory();
                echo "<option value=\"0\">Select SubCategory</option>";
                foreach ($result as $row) {
                    echo "<option style=\"padding-bottom: 1Px;padding-top: 1Px;\"  value=\"" . $row->sub_category_id . "\">" . $row->ssid . "</option>";
                }
            }
        }
        else
            $this->load->view('login/login');
    }

//displayCategoryIPDetail -> Show the category ip addresses allocation to Location->ssid wise.
    function displayCategoryIPDetail($offset = 0) {
        if ($this->session->userdata('Logged_In')) {
            if (!isset($_SERVER['HTTP_X_REQUESTED_WITH'])) {
                redirect('customer_controller/addNewCustomer');
            } else {
                $sub_cat_id = $this->input->post('sub_cat_id');
                $this->customer_model->setSubCatID($sub_cat_id);
                $subcategory = $this->customer_model->getSubCategoryNameByID();

                $config['base_url'] = base_url() . 'index.php/customer_controller/displayCategoryIPDetail/';
                $config['total_rows'] = count($this->customer_model->getCategoryIPDetailsBySubCatID());
                $config['per_page'] = 10;

                $this->pagination->initialize($config);

                $jsFunction['name'] = 'get_CategoryIPDetails_ForSSID_GET';
                $jsFunction['params'] = array($sub_cat_id);

                $this->pagination->initialize_js_function($jsFunction);

                $data['page_link'] = $this->pagination->create_js_links();
                $data['title'] = "Details of SSID [ " . $subcategory['ssid'] . " ]";

                if ($this->customer_model->getCategoryIPDetailsBySubCatID() == 0)
                    $this->load->view('customers/add_categoryIP_null', $data);
                else {
//                    $data['category_ip_details'] = $this->customer_model->getCategoryIPDetailsBySubCatIDPage($config['per_page'],$offset);
                    $data['category_ip_details'] = $this->customer_model->getCategoryIPDetailsBySubCatID();
                    $this->load->view('customers/add_categoryIPs_customer', $data);
                }
            }
        }
        else
            $this->load->view('login/login');
    }

//Add Category/Service IPs to Customers
    function addCategoryIPDetail() {
        if ($this->session->userdata('Logged_In')) {
            if (!isset($_SERVER['HTTP_X_REQUESTED_WITH'])) {
                redirect('customer_controller/addNewCustomer');
            } else {

                $checkedValues = $this->input->post('checked_values');
                $customer_id = $this->input->post('customer');
                $custservid = $this->input->post('custservid');
                $arr = explode(',', trim($checkedValues));
                $arr = array_filter($arr);


                $this->customer_model->setCategoryIPID($arr);
                $this->customer_model->setCustomerID($customer_id);
                $this->customer_model->setCustservID($custservid);
//        echo $checkedValues."  ".$selectedValues."  ".$customer_id;
                $result = $this->customer_model->saveCategoryIPDetailsByCustID();
//$result = 1;
                if ($result) {
//                    $data['assigned_categoryip_details'] = $this->customer_model->getCategoryIPDetailsByCustomerID();
                    $data['assigned_categoryip_details'] = $this->customer_model->getCategoryIPDetailsByCustservID();
                    $data['title'] = "Service Category IP Details";
                    $this->load->view('customers/assigned_categoryip_table', $data);
//                    echo '1';
                }

                else
                    echo'0';
            }
        }
        else
            $this->load->view('login/login');
    }

//Display the ASsigned Category IPs to the Customer Table
    function displayCategoryIPTable() {
        if ($this->session->userdata('Logged_In')) {
            if (!isset($_SERVER['HTTP_X_REQUESTED_WITH'])) {
                redirect('customer_controller/addNewCustomer');
            } else {
                $id=$this->input->post('custservid');
                $custid=$this->input->post('cust_id');
                $enddate=$this->input->post('enddate');
                
                if($custid !=0){
                if($id!=0){
                $this->customer_model->setCustomerID($this->input->post('cust_id'));
                $this->customer_model->setCustservID($this->input->post('custservid'));
//                $data['assigned_categoryip_details'] = $this->customer_model->getCategoryIPDetailsByCustomerID();
                $data['assigned_categoryip_details'] = $this->customer_model->getCategoryIPDetailsByCustservID();
                $data['title'] = "Service Category IP Details";
                $this->load->view('customers/assigned_categoryip_table', $data);
            } else if($id==0){
                $this->customer_model->setCustomerID($this->input->post('cust_id'));
//                $data['assigned_categoryip_details'] = $this->customer_model->getCategoryIPDetailsByCustomerID();
                $data['assigned_categoryip_details'] = $this->customer_model->getCategoryIPDetailsByCustomerIDD();
                $data['title'] = "Service Category IP Details";
                $this->load->view('customers/assigned_categoryip_table_1', $data);
                
            }}
            if($enddate !=0){
                $this->customer_model->setCustomerID($this->input->post('cust_id'));
                $data['assigned_categoryip_details'] = $this->customer_model->getCategoryIPDetailsByCustomerID();
                $data['title'] = "Service Category IP Details";
                $this->load->view('customers/assigned_categoryip_table', $data);
            }
                
            }
        }
        else
            $this->load->view('login/login');
    }

//delete the Assigned Service IP addresses @ add customer form
    function deleteAssignedCategoryIP() {
        if ($this->session->userdata('Logged_In')) {
            if (!isset($_SERVER['HTTP_X_REQUESTED_WITH'])) {
                redirect('customer_controller/addNewCustomer');
            } else {
                $this->customer_model->setCategoryIPID($this->input->post('ip_id'));
                if ($this->customer_model->clearAssignedCategoryIPToCustomer()) {
                    echo '1';
                }
                else
                    echo '0';
            }
        }
        else
            $this->load->view('login/login');
    }

    /* Delete Already Assigned Category IPs ;-> If IPs are assigned before current date -> it will be deleted
      i.e. to_date will be set as current date and new row of same data inserted */

    function deleteAlreadyAssignedCategoryIP(){
        if($this->session->userdata('Logged_In')){
            if (!isset($_SERVER['HTTP_X_REQUESTED_WITH']))
            {
                redirect('customer_controller/addNewCustomer');
            }
            else{
                $this->customer_model->setCategoryIPID($this->input->post('ip_id'));
                $this->customer_model->setRemark($this->input->post('remark'));
                if($this->customer_model->clearAlreadyAssignedCategoryIPToCustomer()){
                    echo '1';
                }
                else echo '0';
            }
        }
        else $this->load->view('login/login');
    }
    
//    function deleteAlreadyAssignedCategoryIP() {
//        if ($this->session->userdata('Logged_In')) {
//            if (!isset($_SERVER['HTTP_X_REQUESTED_WITH'])) {
//                redirect('customer_controller/addNewCustomer');
//            } else {
//                $this->customer_model->setCategoryIPID($this->input->post('ip_id'));
//                if ($this->customer_model->clearAlreadyAssignedCategoryIPToCustomer()) {
//                    echo '1';
//                }
//                else
//                    echo '0';
////                echo $this->customer_model->clearAlreadyAssignedCategoryIPToCustomer();
//            }
//        }
//        else
//            $this->load->view('login/login');
//    }

//To add the Private Ip Blocks assigned to Customers
    function addPrivateIPDetail() {
        if ($this->session->userdata('Logged_In')) {
            if (!isset($_SERVER['HTTP_X_REQUESTED_WITH'])) {
                redirect('customer_controller/addNewCustomer');
            } else {
                $cidr = $this->input->post('cidr');
                $pvtip = $this->input->post('pvt_ip');
                $custid = $this->input->post('customer');
                $custservid = $this->input->post('custservid');
                $this->customer_model->setCustomerID($custid);
                $this->customer_model->setCustservID($custservid);
                $this->customer_model->setPvtCIDR($cidr);
                $this->customer_model->setPvtIP($pvtip);

                $ip = ip2long($pvtip);
                $mask = (-1 << (32 - $cidr));
                $network = $ip & $mask;



//                if(filter_var($pvtip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4) && ($cidr > 0 && $cidr < 32));
//                echo 'invalid';
                if (!filter_var($pvtip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4))
                    echo 0;
                else if ($ip != $network)
                    echo 1;
                else if (!filter_var($pvtip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_RES_RANGE))
                    echo 2;
                else if (!filter_var($pvtip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE)) {
//                        echo "Private IP";
                    $existingip = $this->checkExistPvtIPPerCustomer($custid, $ip, $cidr);

//                    var_dump($existingip);
//                    return;
                    if ($existingip == '') {
                        $this->customer_model->savePrivateIPByCustID();
//                        $data['assigned_pvtip_details'] = $this->customer_model->getPvtIPDetailsByCustomerID();
                        $data['assigned_pvtip_details'] = $this->customer_model->getPvtIPDetailsByCustservID();
//                        print_r( $this->customer_model->getPvtIPDetailsByCustservID());
//                        return;
                        $data['title'] = "Private IP Details";
                        $this->load->view('customers/assigned_pvtip_table', $data);
//                    echo '1';
                    } else if ($existingip != '') {
                        echo '3||';
                        echo "<h4 style=\"color:red\">Cannot be Assigned!</h4>" . $existingip;
                    }

                    else
                        echo 4;
                }
            }
        }
        else
            $this->load->view('login/login');
    }

// Checking Private IPs inside same customer    
    function checkExistPvtIPPerCustomer($custid, $ip, $cidr) {
        $this->customer_model->setCustomerID($custid);
//        $ip = ip2long('192.168.12.0');
//        $cidr = 24;
        $custips = $this->customer_model->checkExistPvtIPPerCustomer();
        $text = '';

        foreach ($custips as $row) {
            $ip1 = $row->ip_addresses;
            $cidr1 = $row->subnet;
            $net = ip2long($ip1) & (-1 << (32 - $cidr1));
            $bcast = ip2long($ip1) | ~(-1 << (32 - $cidr1));

            if ($ip >= $net && $ip <= $bcast) {
                $this->customer_model->setCustservID($row->customer_id);
                $result = $this->customer_model->getLinksDetailbyID();
                foreach ($result as $rows) {
                    $text .= $row->ip_addresses . "/" . $row->subnet . " is already assigned to ";
                    if ($rows->servicecode == 'LN') {
                        $text .="Links(" . $rows->link . ") -- " . $rows->ltown . "</br>";
                    } else {
                        if (strtolower($rows->identify) == "none" || $rows->identify == "")
                            $text .=$rows->service_name . "</br>";
                        else
                            $text .=$rows->service_name . "  " . $rows->identify . "</br>";
                    }
                }
            }
        }
        foreach ($custips as $row) {
            $ip1 = ip2long($row->ip_addresses);
            $net1 = $ip & (-1 << (32 - $cidr));
            $bcast1 = $ip | ~(-1 << (32 - $cidr));
            if ($ip1 >= $net1 && $ip1 <= $bcast1) {

                $this->customer_model->setCustservID($row->customer_id);
                $result = $this->customer_model->getLinksDetailbyID();
                foreach ($result as $rows) {
                    if ($cidr < ($row->subnet)) {

                        $text .= $row->ip_addresses . "/" . $row->subnet . " is already assigned to ";
                        if ($rows->servicecode == 'LN') {
                            $text .="Links(" . $rows->link . ") -- " . $rows->ltown . "</br>";
                        } else {
                            if (strtolower($rows->identify) == "none" || $rows->identify == "")
                                $text .=$rows->service_name . "</br>";
                            else
                                $text .=$rows->service_name . "  " . $rows->identify . "</br>";
                        }
                    }
                }
            }
//            $text .= $ip1." ".$net1." ".$bcast1."</br>";
        }

        return $text;
    }

//Display ASsigned Private IPs table
    function displayPvtIpTable() {
        if ($this->session->userdata('Logged_In')) {
            if (!isset($_SERVER['HTTP_X_REQUESTED_WITH'])) {
                redirect('customer_controller/addNewCustomer');
            } else {
                $id=$this->input->post('custservid');
                $custid=$this->input->post('cust_id');
                $enddate=$this->input->post('enddate');
                
                if($custid !=0){
                if($id!=0){
                $this->customer_model->setCustomerID($this->input->post('cust_id'));
                $this->customer_model->setCustservID($this->input->post('custservid'));
//                $data['assigned_pvtip_details'] = $this->customer_model->getPvtIPDetailsByCustomerID();
                $data['assigned_pvtip_details'] = $this->customer_model->getPvtIPDetailsByCustservID();
                $data['title'] = "Private IP Details";
                $this->load->view('customers/assigned_pvtip_table', $data);
            }else if($id==0){
                $this->customer_model->setCustomerID($this->input->post('cust_id'));
//                $data['assigned_pvtip_details'] = $this->customer_model->getPvtIPDetailsByCustomerID();
                $data['assigned_pvtip_details'] = $this->customer_model->getPvtIPDetailsByCustomerIDD();
                $data['title'] = "Private IP Details";
                $this->load->view('customers/assigned_pvtip_table_1', $data);
            }}
            if($enddate !=0){
                $this->customer_model->setCustomerID($this->input->post('cust_id'));
                $data['assigned_pvtip_details'] = $this->customer_model->getPvtIPDetailsByCustomerID();
                $data['title'] = "Private IP Details";
                $this->load->view('customers/assigned_pvtip_table', $data);
            }
                
            }
        }
        else
            $this->load->view('login/login');
    }

//Delete Assigned Private IPs :-> Same as Category IPs-> once deleted end date is assigned
    function deleteAssignedPvtIP() {
        if ($this->session->userdata('Logged_In')) {
            if (!isset($_SERVER['HTTP_X_REQUESTED_WITH'])) {
                redirect('customer_controller/addNewCustomer');
            } else {
                $this->customer_model->setPvtIPID($this->input->post('pvt_ip_id'));
                if ($this->customer_model->deleteAssignedPrivateIPToCustomer()) {
                    echo '1';
                }
                else
                    echo '0';
            }
        }
        else
            $this->load->view('login/login');
    }

    //15-Aug-12:End
    //16-Aug-12:Begin
    //To View the Customer->ViewCustomer Controller
    function ViewCustomer($id = 0, $iid=0) {
        if ($this->session->userdata('Logged_In')) {
            $data['title'] = "View Customers";
            $data['customers'] = $this->customer_model->getCustomerDetails();
            $data['crm_customers'] = $this->customer_model->getCustomerDetails_crm();
            $data['custid'] = $id;
            $data['linkid'] = $iid;
            $partials = array('content' => 'customers/view_customer');
            $this->template->load('template/simpla_template', $partials, $data);
        }
        else
            $this->load->view('login/login');
    }

//Add Temporary Customer Allocation Page is loaded
    function addTempCustomer() {
        if ($this->session->userdata('Logged_In')) {
            $data['title'] = "Add Temporary Customer";
            $data['customers'] = $this->customer_model->getCustomerDetails();
            $data['node_sub_cat'] = $this->customer_model->getNodeSubCategory();
            $data['locations'] = $this->customer_model->getLocations();
            $data['categories'] = $this->customer_model->getCategories();
            $partials = array('content' => 'customers/add_temp_customer');
            $this->template->load('template/simpla_template', $partials, $data);
        }
        else
            $this->load->view('login/login');
    }

//Save Temporary Customer :->after Details were inputted and Display Add Ips View and Tables
    function saveTempCustomer() {
        if ($this->session->userdata('Logged_In')) {
            if (!isset($_SERVER['HTTP_X_REQUESTED_WITH'])) {
                redirect('customer_controller/addTempCustomer');
            } else {
                $this->customer_model->setCustomerName($this->input->post('cust'));
                $this->customer_model->setAddress($this->input->post('add'));
                $this->customer_model->setBW($this->input->post('bw'));
                $this->customer_model->setConnectionName($this->input->post('conn'));
                $this->customer_model->setEndDate($this->input->post('end_date'));
                if ($this->input->post('end_date') < date("Y-m-d"))
                    echo '2';
                else {
                    if ($this->customer_model->saveTemporaryCustomer()) {
                        $this->customer_model->setCustomerName($this->input->post('cust'));
                        $detail = $this->customer_model->getLastTempCustDetailByCustName();
                        foreach ($detail as $row) {
                            echo"<input type=\"hidden\" id=\"LinkService\" value=\"" . $row->customer_id . "\"/>";
                            echo "<b> Customer ID &nbsp;&nbsp;&nbsp;: </b>\t" . $row->customer_id . "<br><p></p>";
                            echo "<b> Customer Name &nbsp;&nbsp;&nbsp;: </b>\t" . $row->customer_name . "<br><p></p>";
                            echo "<b>Address &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</b>\t" . $row->address . "<br><p></p>";
                            echo "<b>Connection Type &nbsp;&nbsp;:</b>\t" . $row->connection_name . "<br><p></p>";
                            echo "<b>Bandwidth&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:\t</b>" . $row->bandwidth . "<br><p></p>";
                            echo "<b>Termination Date  &nbsp;:\t</b>" . $row->end_date . "<br><p></p>";
                        }
                    }
                    else
                        echo '0';
                }
            }
        }
        else
            $this->load->view('login/login');
    }

    function editTempCustomer($id) {

        if ($this->session->userdata('Logged_In')) {
            $this->customer_model->setCustomerID($id);
            $data['title'] = "Edit Temporary Customer";
            $data['customers'] = $this->customer_model->getCustomerDetails();
            $data['node_sub_cat'] = $this->customer_model->getNodeSubCategory();
            $data['locations'] = $this->customer_model->getLocations();
            $data['categories'] = $this->customer_model->getCategories();
            $partials = array('content' => 'customers/edit_temp_customer');
            $this->template->load('template/simpla_template', $partials, $data);
        }
        else
            $this->load->view('login/login');
    }

//Display Temporary Customer Allocations Tables and IPs details
    function viewTempCustomer($id = 0) {
        if ($this->session->userdata('Logged_In')) {
            $data['title'] = "View Temporary Customer Details";
            $data['customers'] = $this->customer_model->getCustomerDetails();
            $data['node_sub_cat'] = $this->customer_model->getNodeSubCategory();
            $data['locations'] = $this->customer_model->getLocations();
            $data['select_value'] = $id;
            $data['categories'] = $this->customer_model->getCategories();
            $partials = array('content' => 'customers/view_temp_customer');
            $this->template->load('template/simpla_template', $partials, $data);
        }
        else
            $this->load->view('login/login');
    }

//Remove Temporary Allocation -> Customer end date is assigned and status set to 1
    function deleteTempCustomer() {
        if ($this->session->userdata('Logged_In')) {
            if (!isset($_SERVER['HTTP_X_REQUESTED_WITH'])) {
                redirect('customer_controller/viewTempCustomer');
            } else {
                $this->customer_model->setCustomerID($this->input->post('cust_id'));
                if ($this->customer_model->deleteTemporaryCustomer()) {
                    echo '1';
                }
                else
                    echo '0';
            }
        }
        else
            $this->load->view('login/login');
    }

//To Display End Date for the Temporary Allocation Customers
    function displayEndDate() {
        if ($this->session->userdata('Logged_In')) {
            if (!isset($_SERVER['HTTP_X_REQUESTED_WITH'])) {
                redirect('customer_controller/viewTempCustomer');
            } else {
                $this->customer_model->setCustomerID($this->input->post('cust_id'));
                $enddate = $this->customer_model->getEndDateperID();
                echo $enddate['end_date'];
            }
        }
        else
            $this->load->view('login/login');
    }

    //16-Aug-12:End
//To get Notification of the Expired Temporary Allocation Details
    function getNotifications() {
        if ($this->session->userdata('Logged_In')) {
            if (!isset($_SERVER['HTTP_X_REQUESTED_WITH'])) {
                redirect('customer_controller/viewTempCustomer');
            } else {
                $data['temp_allocation'] = $this->customer_model->getTempAllocationTerminations();
                $this->load->view('customers/temp_customer_notifications', $data);
            }
        }
        else
            $this->load->view('login/login');
    }

    /*     * *****************Functions Written for customer related tables in CRM*************** */

    function displayLinkServiceDetails() {
        if ($this->session->userdata('Logged_In')) {
            if (!isset($_SERVER['HTTP_X_REQUESTED_WITH'])) {
                redirect('customer_controller/addNewCustomer');
            } else {
                $this->customer_model->setCustomerID($this->input->post('cust_id'));
                $this->customer_model->setCustservID($this->input->post('custserv_id'));
                $result1 = $this->customer_model->getCustomerLinksbyID();
                $linkdetails = $this->customer_model->getLinksDetailbyID();

                $links = array();
                foreach ($result1 as $row) {
                    $links[] = $row->link;
                }
                if (!empty($links)) {
                    $this->customer_model->setLinks($links);
                    $mainlinks = $this->customer_model->getMainLinkbyID();
                    $service = array();
                    $serviceid = array();
                    foreach ($mainlinks as $row) {
                        $service[$row->link] = $row->name;
                        $serviceid[$row->link] = $row->id;
                    }
                }


                foreach ($linkdetails as $row) {
//                    if(array_key_exists($row->link, $service))
                    if (!empty($service[$row->link]))
                        $internet = $this->customer_model->getInternetTypes($serviceid[$row->link]);
                    ?>
                    <p><b> Link Town&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: &nbsp;&nbsp; </b>
                        <b><span>
                                <?php
                                if ((strtolower($row->identify) == "none") || ($row->identify == ""))
                                    echo $row->ltown;
                                else
                                    echo $row->ltown . " (" . $row->identify . ")";
                                ?>
                            </span></b>
                    </p>
                    <p><b> Customer Service ID&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: &nbsp;&nbsp; </b>
                        <b><span><?php echo $row->id; ?></span></b>
                    </p>
                    <p><b> Services&nbsp;&nbsp;: &nbsp;&nbsp; </b>
                        <b> <span><?php
                    if (empty($service[$row->link]))
                        echo $row->service_name; else {
//                        echo $service[$row->link] . "&nbsp&nbsp";
//                        if ($internet['internet_type'] != '' || $internet['speedtype'] != 0)
//                            echo $internet['internet_type'] . "(" . $internet['speed'] . ")";

                        foreach ($mainlinks as $rows) {
                            if ($rows->link == $row->link) {
                                $internet = $this->customer_model->getInternetTypes($rows->id);
                                echo "<li style='margin-left:80px;'>Name: " . $rows->name . "&nbsp&nbsp&nbsp";
                                if ($internet['internet_type'] != '' || $internet['speedtype'] != 0)
                                    echo "Type: " . $internet['internet_type'] . "(" . $internet['speed'] . ")&nbsp&nbsp&nbsp";
                                $status = $rows->connstatus;
                                if ($status == 1) {
                                    echo "Status: Active";
                                }
                                if ($status == 5) {
                                    echo "Status: Terminated";
                                }
                                if ($status == 4) {
                                    echo "Status: Temporary Discconnected";
                                }
                                if ($status == 7) {
                                    echo "Status: Pending Works Order";
                                }
                                echo "</li>";
                            }
                        }
                    }
                                ?></span></b>
                    </p>
                    <p ><b> Status&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: &nbsp;&nbsp; </b>
                        <b> <span>
                                <?php
                                $status = $row->connstatus;
                                if ($status == 1) {
                                    echo "Active";
                                }
                                if ($status == 5) {
                                    echo "Terminated";
                                }
                                if ($status == 4) {
                                    echo "Temporary Discconnected";
                                }
                                if ($status == 7) {
                                    echo "Pending Works Order";
                                }
                                ?>
                            </span></b>
                    </p>
                    <p><b> Location&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: &nbsp;&nbsp; </b>
                        <b> <span><?php echo $row->location; ?></span></b>
                    </p>
                    <?php
                }
            }
        }
        else
            $this->load->view('login/login');
    }

    function test() {
        echo $this->checkExistPvtIPPerCustomer(2693);
    }

    /*     * **********************************End of CRM functions********************************* */
}