<?php

/**
 *  DATE            NAME            DESCRIPTION
 * 25 Jul 2012      Nirosan         Assign IP blocks and View assigned blocks.
 *
 * 13 Aug 2012      Nirosan         Modify according to database change.
 */
class Ipblock_Controller extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('ipblock_model');
        $this->load->library('pagination');
    }

//Loading add_block view.
    public function add_ipblock() {
        if ($this->session->userdata('Logged_In')) {
            $data['title'] = "Assign IP blocks";
            $data['category'] = $this->ipblock_model->get_category();
            $partials = array('content' => 'ip/add_ipblock');
            $this->template->load('template/simpla_template', $partials, $data);
        }
        else
            $this->load->view('login/login');
    }

//Get the sub categories while changing the category
    public function get_subcategory() {
        $cat_id = trim($this->input->post('cat_id'));
        $this->ipblock_model->setCategoryId($cat_id);
        $subcategory = $this->ipblock_model->get_subcategory();

        if ($cat_id == 0) {
            ?>
        <b>Select Subcategory: &nbsp;</b>
        <select id="subcategory">
            <option value="0">Select a category first</option>
        </select>
        <?php
        }

        if (!empty($cat_id)) {
            ?>
        <b>Select Subcategory: &nbsp;</b>
        <select id="subcategory"  onchange="getIds()">
            <option value="0">Please select</option>
            <?php foreach ($subcategory->result() as $row) { ?>
            <option value="<?php echo $row->sub_category_id; ?>"><?php if($cat_id==1){ echo $row->location . "--" . $row->ssid;}else    echo ucfirst ($row->ssid);  ?></option>
            <?php } ?>
        </select>
        <?php
        }
    }


//Show free IP blocks to assign for Nodes.
    public function view_nodeblocks($offset=0) {
        $cat_id = $this->input->post('cat_id');
        if ($cat_id == 1) {
            $data['title'] = 'Select Node blocks';
            $config['base_url'] = base_url() . 'index.php/ipblock_controller/view_nodeblocks/';
            $config['total_rows'] = count($this->ipblock_model->get_primarysubpool());
            $config['per_page'] =16;
            $this->pagination->initialize($config);
            $jsFunction['name'] = 'viewNodeblock_pagination';
            $jsFunction['params'] = array($cat_id);
            $this->pagination->initialize_js_function($jsFunction);

            $data['per_page']=$config['per_page'];
            $data['offset']=$offset;
            $data['page_link'] = $this->pagination->create_js_links();
            $this->load->view('ip/available_primarysubpool', $data);
        }

    }

//Show available ip blocks for locations and other sub categories.
    public function view_ipblocks($offset=0) {
        $cat_id = $this->input->post('cat_id');
        $subcat_id = $this->input->post('subcat_id');
        $this->ipblock_model->setSubcategoryId($subcat_id);
        $detail = $this->ipblock_model->get_ssidlocation();
        foreach ($detail->result() as $row) {
            $ssid = $row->ssid;
            $location = $row->location;
        }
        //If category is NODE
        if ($cat_id == 1 && $subcat_id != 0) {
            $config['total_rows'] = count($this->ipblock_model->get_nodeblocks());
            $config['per_page'] =16;
            $this->pagination->initialize($config);
            $jsFunction['name'] = 'viewIpblock_pagination';
            $jsFunction['params'] = array($cat_id,$subcat_id);
            $this->pagination->initialize_js_function($jsFunction);
            $data['per_page']=$config['per_page'];
            $data['offset']=$offset;
            $data['page_link'] = $this->pagination->create_js_links();
            $data['title'] = 'Select IP blocks for ssid ' . $ssid . ' & location ' . $location;
            $this->load->view('ip/node_location_blocks', $data);

        }
        //If category is other than node
        else if ($cat_id != 1 && $subcat_id != 0) {
            $config['total_rows'] = count($this->ipblock_model->get_primarysubpool());
            $config['per_page'] =16;
            $this->pagination->initialize($config);
            $jsFunction['name'] = 'viewIpblock_pagination';
            $jsFunction['params'] = array($cat_id,$subcat_id);
            $this->pagination->initialize_js_function($jsFunction);
            $data['per_page']=$config['per_page'];
            $data['offset']=$offset;
            $data['page_link'] = $this->pagination->create_js_links();
            $data['title'] = 'Select IP blocks for Subcategories.';
            $this->load->view('ip/available_primarysubpool', $data);
        } else if ($subcat_id == 0) {
            echo 0;
        }
    }


//  Show Selected ip blocks in the IP Address text field with their Subnet.
    public function add_nodeblocks() {
        
        $subpool_id = $this->input->post('subpool_id'); 
        $arr2 = explode(',', trim($subpool_id));
        $arr = array_filter($arr2);
        $this->ipblock_model->setSubPoolId($arr); 
        $arr1 = $this->ipblock_model->get_primarysubpoolsbyIds();       
        $subnet = array();
        $ipadd = array();
        $cidr = array();

        foreach (array_keys($arr1) as $k) {
            $subnet[$k] = &$arr1[$k]['subnet'];
            $ipadd[$k] = &$arr1[$k]['sub_pool_values'];
        }
        for ($i = 0; $i < count($subnet); $i++) {
            $cidr[$i] = $ipadd[$i] . "/" . $subnet[$i];
        }
        

            ?>
        <div id='ipaddress'>
            <label>IP address! [IPv4] CIDR:</label>

            <textarea id="txtcidr" rows="5" readonly="readonly" style="line-height: 1.4em"><?php echo implode(',  ', $cidr); ?></textarea>
        </div>
        <input type="hidden" id="checked" value="<?php echo $subpool_id;?>"/>
        <?php

    }

//  Show Selected ip blocks for location in the IP Address text field with their subnet.
    public function add_locationIP() {
        $notify = false;
        $ip_id = $this->input->post('ip_id');

        $arr2 = explode(',', trim($ip_id));
        $arr = array_filter($arr2);
        $this->ipblock_model->setNodeipId($arr);
        $arr1 = $this->ipblock_model->get_nodeblocksbyIds();
        $subnet = array();
        $ipadd = array();
        $cidr = array();
        foreach (array_keys($arr1) as $k) {
            $subnet[$k] = &$arr1[$k]['subnet'];
            $ipadd[$k] = &$arr1[$k]['ip_addresses'];
        }
        for ($i = 0; $i < count($subnet); $i++) {
            $cidr[$i] = $ipadd[$i] . "/" . $subnet[$i];
        }
        foreach ($subnet as $value) {
            if ($value < 28) {
                $notify = true;
            }
        }
        if ($notify)
            echo '<script type="text/javascript">alert("You are about to add IP block for a location that can be subnetted.")</script>';


            ?>

        <div id='ipaddress'>
            <label>IP address! [IPv4] CIDR:</label>

            <textarea id="txtcidr" rows="5" readonly="readonly" style="line-height: 1.4em"><?php echo implode(',  ', $cidr); ?></textarea>
        </div>
        <input type="hidden" id="checked" value="<?php echo $ip_id;?>"/>
        <?php

    }
    
    

//Assigning IP blocks for Nodes, Node locations, Other categories.
    public function save_ipblocks() {
        $node_blocks = $this->input->post('node_blocks');
        $cat_id = $this->input->post('cat_id');
        $subcat_id = $this->input->post('subcat_id');
//        print_r($this->input->post('subpool_id'));return;
//Saving IP blocks for Node category.
        if ($cat_id == 1 && $subcat_id == 0) {
            if ($node_blocks != 0) {
                $subpool_id = $this->input->post('subpool_id');
                $this->ipblock_model->setCategoryId($cat_id);
                $this->ipblock_model->setSubPoolId($subpool_id);
                if ($this->ipblock_model->add_nodeblocks()) {
                    echo "IP blocks\" " . $node_blocks . " \"are assigned for nodes.";
                }
            }
            else
                echo "Please select some IP blocks";
        }

//Saving IP blocks for Node Locations.
        elseif ($cat_id == 1 && $subcat_id != 0) {

            if ($node_blocks != '') {
                $ip_id = $this->input->post('subpool_id');
                $arr = explode(',', trim($ip_id));
                $arr = array_filter($arr);
//                print_r($arr);return;
                $this->ipblock_model->setNodeipId($arr);
                $this->ipblock_model->setSubcategoryId($subcat_id);
                $this->ipblock_model->update_nodeip();
                $detail = $this->ipblock_model->get_ssidlocation();
                foreach ($detail->result() as $row) {
                    $ssid = $row->ssid;
                    $location = $row->location;
                }
                $arr1 = $this->ipblock_model->get_nodeblocksbyIds();
                $subnet = array();
                $ipadd = array();
                foreach (array_keys($arr1) as $k) {
                    $subnet[$k] = &$arr1[$k]['subnet'];
                    $ipadd[$k] = &$arr1[$k]['ip_addresses'];
                }
                for ($i = 0; $i < count($ipadd); $i++) {

                    //calling the function add_nodedetails() to subnet the blocks assigned to a location.
                    $ip_addresses[$i] = $this->add_nodedetails($ipadd[$i], $subnet[$i]);
                    for ($j = 0; $j < count($ip_addresses[$i]); $j++) {
                        $this->ipblock_model->setSubcategoryId($subcat_id);
                        $this->ipblock_model->setNodeipId($arr[$i]);
                        $this->ipblock_model->setSubnet($subnet[$i]);
                        $this->ipblock_model->setIpAddresses($ip_addresses[$i][$j]);
                        $this->ipblock_model->add_nodedetails();
                    }
                }
                echo "IP blocks are added to Location: " . $location . " & ssid: " . $ssid . " " . $node_blocks;
            }
            else
                echo "Please select some IP blocks";
        }

//Saving IP blocks for categories other than Node.
        else {
            $subpool_id = $this->input->post('subpool_id');
            $this->ipblock_model->setCategoryId($cat_id);
            $this->ipblock_model->setSubcategoryId($subcat_id);
            $this->ipblock_model->setSubPoolId($subpool_id);
            if ($this->ipblock_model->add_categoryblocks()) {
                echo "IP blocks \" " . $node_blocks . " \" are assigned for category.";
            }
        }
    }


//Subnetting the blocks assigned for a location and save it in Node detail table.
//All networks are subnetted as individual ips.
    public function add_nodedetails($ip, $netbits) {
        $subnet = 32;
        $ip = ip2long($ip);

        //check whether ipv4
        if ($ip == -1 || $ip === FALSE) {
            echo "Invalid address, please try again.";
        } else {
            $mask = ip2long('255.255.255.255') << (32 - (int) $netbits);//generating subnet mask.
            $network = ($ip & $mask);//generating network address.
            if ($subnet != '') {
                $length = 1 << ($subnet - $netbits);
                $d = 1 << (32 - $subnet);
                $ips = array();
                for ($i = 0; $i <= $length - 1; $i++) {
                    $t = $d * $i;
                    $ips[] = long2ip($network + $t);
                }
            }
        }
        return $ips;
    }



    /*
     * Functions for view assigned IP blocks...!!!!
     *
     * * */

//Interface for view assigned blocks.
    public function assigned_ipblocks($id = 0,$iid=0) {
        if ($this->session->userdata('Logged_In')) {
            $data['title'] = "View Assigned IP blocks";
            $data['category'] = $this->ipblock_model->get_category();
            $data['catt_id']=$id;
            $data['subcatt_id']=$iid;
            $partials = array('content' => 'ip/view_ipblock');
            $this->template->load('template/simpla_template', $partials, $data);
        }
        else
            $this->load->view('login/login');
    }

//Drop downs to select category and sub category.
    public function get_subcategoryforview() {
        $cat_id     = trim($this->input->post('cat_id'));
        $subcatt_id = trim($this->input->post('subcatt_id'));
        $this->ipblock_model->setCategoryId($cat_id);

        $subcategory = $this->ipblock_model->get_subcategory();
        $location = $this->ipblock_model->get_alllocation();

        if ($cat_id == 0) {
            ?>
        <b>Select Subcategory: &nbsp;</b>
        <select id="subcategory">
            <option value="0">Select a category first</option>
        </select>
        <?php
        }

        else if ($cat_id == 1) {
            ?>
        <b>Select Location: &nbsp;</b>
        <select id="subcategory"  onchange="getIds()">
            <option value="0">Please select</option>
            <?php foreach ($location->result() as $row) {
            if($row->location_id == $subcatt_id){?>
                <option value="<?php echo $row->location_id; ?>" selected="selected"><?php echo $row->location; ?></option>
                <?php }else {?>
                <option value="<?php echo $row->location_id; ?>"><?php echo $row->location; ?></option>

                <?php }} ?>
        </select>
        <?php
        }
        else {
            ?>
        <b>Select Subcategory: &nbsp;</b>
                <select id="subcategory"  onchange="getIds()">
                    <option value="0">Please select</option>
            <?php foreach ($subcategory->result() as $row) {
                if($row->sub_category_id == $subcatt_id){?>
                    <option value="<?php echo $row->sub_category_id; ?>" selected="selected"><?php echo $row->ssid; ?></option>
                    <?php }else {?>
                    <option value="<?php echo $row->sub_category_id; ?>"><?php echo $row->ssid; ?></option>

                    <?php }} ?>
            <?php } ?>
                </select>
                <?php
    }



//View assigned node blocks
    public function view_assigned_nodeblocks($offset=0) {

//        $config['base_url'] = base_url() . 'index.php/ipblock_controller/view_assigned_nodeblocks/';
        $config['total_rows'] = count($this->ipblock_model->get_allnodeip());
        $config['per_page'] = 10;
        $this->pagination->initialize($config);
        $jsFunction['name'] = 'viewAssignedNodeblock_pagination';
        $jsFunction['params'] = array();
        $this->pagination->initialize_js_function($jsFunction);
        $data['per_page'] = $config['per_page'];
        $data['offset'] = $offset;
        $data['page_link'] = $this->pagination->create_js_links();
        $this->load->view('ip/nodeip_table', $data);
    }

    public function view_assigned_ipblocks($offset=0) {
        $cat_id = $this->input->post('cat_id');
        $subcat_id = $this->input->post('subcat_id');

//View assigned IP blocks for locations.
        if ($cat_id == 1) {
            $this->ipblock_model->setLocationId($subcat_id);
//        $config['base_url'] = base_url() . 'index.php/ipblock_controller/view_assigned_ipblocks/';
            $config['total_rows'] = count($this->ipblock_model->get_locationip());
            $config['per_page'] = 10;
            $this->pagination->initialize($config);
            $jsFunction['name'] = 'viewAssignedlocationblock_pagination';
            $jsFunction['params'] = array($cat_id, $subcat_id);
            $this->pagination->initialize_js_function($jsFunction);
            $data['per_page'] = $config['per_page'];
            $data['offset'] = $offset;
            $data['title'] = "IP blocks Assigned for Location-" . $this->ipblock_model->get_location();
            $data['page_link'] = $this->pagination->create_js_links();
            $this->load->view('ip/nodelocation_table', $data);
        } else {

            $this->ipblock_model->setCategoryId($cat_id);
            $this->ipblock_model->setSubcategoryId($subcat_id);
            $config['total_rows'] = count($this->ipblock_model->get_subcategoryip());
            $config['per_page'] = 10;
            $this->pagination->initialize($config);
            $jsFunction['name'] = 'viewAssignedcategoryblock_pagination';
            $jsFunction['params'] = array($cat_id, $subcat_id);
            $this->pagination->initialize_js_function($jsFunction);
            $data['per_page'] = $config['per_page'];
            $data['offset'] = $offset;

            //View assigned IP blocks for Category.
            if ($subcat_id == 0) {
                $data['title'] = "IP blocks Assigned for category " . $this->ipblock_model->get_categoryname();
            } else {
                $data['title'] = "IP blocks Assigned for category " . $this->ipblock_model->get_categoryname() . " & ssid " . $this->ipblock_model->get_ssid();
            }
            $data['page_link'] = $this->pagination->create_js_links();
            $this->load->view('ip/category_table', $data);
        }
    }

//Open node details
    public function open_node_details($offset=0) {
        $nodeip_id = $this->input->post('nodeip_id');
        $this->ipblock_model->setNodeipId($nodeip_id);
        $config['total_rows'] = count($this->ipblock_model->get_nodedetails());
        $config['per_page'] = 16;
        $this->pagination->initialize($config);
        $jsFunction['name'] = 'openNodeDetails_pagination';
        $jsFunction['params'] = array($nodeip_id);
        $this->pagination->initialize_js_function($jsFunction);
        $data['page_link'] = $this->pagination->create_js_links();
        $data['per_page'] = $config['per_page'];
        $data['offset'] = $offset;
        if (count($this->ipblock_model->get_nodedetails()) != 0) {
            $this->load->view('ip/view_node_details', $data);
        }else
            echo 0;
    }

//Open category details
    public function open_category_details() {
        $ip_id = $this->input->post('ip_id');
        $this->ipblock_model->setIpId($ip_id);
        $details = $this->ipblock_model->get_customerbyip();
        foreach ($details->result() as $row) {
            $data['name'] = $row->name;
            $data['date'] = $row->from_date;
        }
        if ($data['name'] == '') {
            echo 0;
        } else {
            ?>
        <h3>Customer Details.</h3><hr>
        <p>
            <strong>Customer Name: </strong><?php echo $data['name'] ?><br/>
            <strong>Date Assigned: </strong><?php echo $data['date'] ?><br />
            <strong>Assigned by: </strong>
        </p>
        <?php
        }
    }


    /*Function to delete Node blocks.
  if customers are assigned cannot be deleted.
   * */

    public function delete_nodeblocks() {
        $ip_id = $this->input->post('ip_id');
        $this->ipblock_model->setNodeipId($ip_id);
        $details = $this->ipblock_model->get_nodeipbyid();
        foreach ($details->result() as $row) {
            $cat_id = $row->category_id;
            $subcat_id = $row->sub_category_id;
            $subpool_id = $row->sub_pool_id;
        }
        $this->ipblock_model->setCategoryId($cat_id);
        $this->ipblock_model->setSubcategoryId($subcat_id);
        $this->ipblock_model->setSubPoolId($subpool_id);
        if(!($this->ipblock_model->check_nodedetail($ip_id))){
            if ($this->ipblock_model->delete_nodeblocks()) {
                if ($subcat_id == 0) {
                    echo 0;
                }else
                    echo 1;
            }
        }else echo 2;
    }

    /*
   * Function to delete assigned categories.
   * These also cannot be deleted if customers are assigned.
   * */

    public function delete_categoryblocks() {
        $ip_id = $this->input->post('ip_id');
        $this->ipblock_model->setIpId($ip_id);
        $arr = $this->ipblock_model->get_customerbyip()->row_array();
        $cus_id = $arr['customer_id'];
        $this->ipblock_model->setCustomerId($cus_id);

        //check whether customer is assigned or not.
        if ($cus_id == null) {
            if ($this->ipblock_model->delete_categoryblocks()) {
                echo 1;
            }
            else
                echo 2;
        }
    }
}
?>