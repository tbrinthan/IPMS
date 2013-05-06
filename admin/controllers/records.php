<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Nirosan
 * Date: 8/28/12
 * Time: 10:03 AM
 * To change this template use File | Settings | File Templates.
 */
    class Records extends CI_Controller{

        function __construct(){
            parent::__construct();
            $this->load->model('records_model');
        }

        public function customer_records($id=0){

            if($this->session->userdata('Logged_In')){
                $data['title']="View Records";
                $data['customers']=$this->records_model->get_customer_details();
                $data['select_value']=$id;
                $partials = array('content'=>'records/customer_records');
                $this->template->load('template/simpla_template',$partials,$data);
            }
            else $this->load->view('login/login');
        }

        public function customer_details(){
            $cust_id=$this->input->post('cust_id');
            $this->records_model->setCustomerId($cust_id);
            $add=$this->records_model->get_customer_byId();
            foreach($add as $row){
                $address=$row->address;
            }
//            if nodes are assigned for customer
            if($this->records_model->get_customer_node()){
                $chk1 =  1;
            }
            else $chk1 = 0;
//            if categories are assigned for customers
            if($this->records_model->get_customer_category()){
                $chk2= 2;
            }
            else $chk2= 0 ;
//            if private ips are assigned for customers
            if($this->records_model->get_customer_private()){
                $chk3= 3;
            }
            else $chk3= 0;
            echo $chk1.'/||\\'.$chk2.'/||\\'.$chk3.'/||\\'.$address;
        }
//loads the nodes assigned for a perticular customer
        public function node_table(){
            if($this->session->userdata('Logged_In')){
                if (!isset($_SERVER['HTTP_X_REQUESTED_WITH']))
                {
                    redirect('records/customer_records');
                }
                else{
                    $cust_id=$this->input->post('cust_id');
                    $this->records_model->setCustomerId($cust_id);
                    $data['title']= "Node IP Details";
                    $this->load->view('records/table_nodeip',$data);
                }
            }
            else $this->load->view('login/login');
        }

//Loads the category ips assigned for the customer
        public function category_table(){
            if($this->session->userdata('Logged_In')){
                if (!isset($_SERVER['HTTP_X_REQUESTED_WITH']))
                {
                    redirect('records/customer_records');
                }
                else{
                    $cust_id=$this->input->post('cust_id');
                    $this->records_model->setCustomerId($cust_id);
                    $data['title']= "Service Category IP Details";
                    $this->load->view('records/table_categoryip',$data);

                }
            }
            else $this->load->view('login/login');
        }
//Loads the private ips assigned for the customer
        public function private_table(){
            if($this->session->userdata('Logged_In')){
                if (!isset($_SERVER['HTTP_X_REQUESTED_WITH']))
                {
                    redirect('records/customer_records');
                }
                else{
                    $cust_id=$this->input->post('cust_id');
                    $this->records_model->setCustomerId($cust_id);
                    $data['title']= "Private IP Details";
                    $this->load->view('records/table_privateip',$data);

                }
            }
            else $this->load->view('login/login');
        }
//search by ip blocks and view customer records.
        function ipBlockSearch(){
            if($this->session->userdata('Logged_In')){
                if (!isset($_SERVER['HTTP_X_REQUESTED_WITH']))
                {
                    redirect('records/customer_records');
                }
                else{
                    $search = $this->input->post('search');
                    $this->records_model->setIpSearch($search);
                    $result =  $this->records_model->searchNodeIP();
                    $result1 =  $this->records_model->searchCategoryIP();
                    $result2=$this->records_model->searchPrivateIP();


                    echo '<div class="result">';
                    echo '<ul class="search-results">';
                    foreach($result as $row){
                        if($row->customer_id != NULL){
                            echo '<li>';
                            echo '<p style="display: none">';
                            echo '<h2><a href="'.base_url().'index.php/records/customer_records/'.$row->customer_id.'">'.$row->customer_name.'</a></h2>';
                            echo '<p>'.str_ireplace($search,'<span class = "highlight">'.$search.'</span>',$row->ip_addresses).'</p>';
                            if(($row->to_date)!=null)
                                echo '<p> Assigned ON:&nbsp&nbsp'.$row->from_date.'</p><p> Removed ON:&nbsp&nbsp'.$row->to_date.'</p>';
                            else
                                echo '<p> Assigned ON:&nbsp&nbsp'.$row->from_date.'</p><p> Removed ON:&nbsp&nbsp In Use</p>';
                            echo '<p>Node IP</p>';
                            echo '</p>';

                            echo  '</li>';
                        }

                    }

                    foreach($result1 as $row){
                        if($row->customer_id != NULL){
                            echo '<li>';
                            echo '<p>';

                            echo '<h2><a href="'.base_url().'index.php/records/customer_records/'.$row->customer_id.'">'.$row->customer_name.'</a></h2>';
                            echo '<p>'.str_ireplace($search,'<span class = "highlight">'.$search.'</span>',$row->ip_addresses).' /'.$row->subnet.'</p>';
                            if(($row->to_date)!=null)
                                echo '<p> Assigned ON:&nbsp&nbsp'.$row->from_date.'</p><p> Removed ON:&nbsp&nbsp'.$row->to_date.'</p>';
                            else
                                echo '<p> Assigned ON:&nbsp&nbsp'.$row->from_date.'</p><p> Removed ON:&nbsp&nbsp In Use</p>';
                            echo '<p>'.$row->ssid.' IP</p>';
                            echo '</p>';

                            echo  '</li>';
                        }

                    }

                    foreach($result2 as $row){
                        if($row->customer_id != NULL){
                            echo '<li>';
                            echo '<p>';

                            echo '<h2><a href="'.base_url().'index.php/records/customer_records/'.$row->customer_id.'">'.$row->customer_name.'</a></h2>';
                            echo '<p>'.str_ireplace($search,'<span class = "highlight">'.$search.'</span>',$row->ip_addresses).' /'.$row->subnet.'</p>';
                            if(($row->to_date)!=null)
                                echo '<p> Assigned ON:&nbsp&nbsp'.$row->from_date.'</p><p> Removed ON:&nbsp&nbsp'.$row->to_date.'</p>';
                            else
                                echo '<p> Assigned ON:&nbsp&nbsp'.$row->from_date.'</p><p> Removed ON:&nbsp&nbsp In Use</p>';
                            echo '<p>Private IP</p>';
                            echo '</p>';

                            echo  '</li>';
                        }

                    }
                    echo '</ul>';
                    echo '</div>';
                }
            }
            else $this->load->view('login/login');
        }
    }

?>