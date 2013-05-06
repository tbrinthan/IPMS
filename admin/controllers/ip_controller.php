<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * DATE         NAME        DESCRIPTION
 * 25Jul2012    Brinthan    AddIP Pool function
 * 26 Jul 2012  Brinthan    IP Pool to -> SubIPPrimary POol addition generated.
 * 06 Aug 2012  Brinthan    Ip POol view->ajax Call
 */

class IP_Controller extends CI_Controller{
//25Jul 2012 :begin
    public function __construct(){
       parent::__construct();
        $this->load->model('ip_model');
        $this->load->library('pagination');
    }
    public function index(){
        redirect('ip_controller/addIPPool');
    }

//adding the Basic Major IP pool to the system
    public function addIPPool(){
        if($this->session->userdata('Logged_In')){

        $data['title']      =   "Add New IP Pool";
        $data['ip_pools']   =   $this->ip_model->getIPPool();


            $partials       =   array('content'=> 'ip/add_ip_pool');
        $this->template->load('template/simpla_template',$partials,$data);

        }
        else $this->load->view('login/login');
    }

    public function saveIPPool(){
        if($this->session->userdata('Logged_In')){
            if (!isset($_SERVER['HTTP_X_REQUESTED_WITH'])){

                redirect('ip_controller/addIPPool');
            }

            else{
                $ippool = $this->input->post('ip_pool');
                $subnet = $this->input->post('subnet');

                if (filter_var($ippool, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4 | FILTER_FLAG_NO_PRIV_RANGE) && ($subnet > 0 && $subnet <= 24)) {
                    $this->ip_model->setPoolValue($ippool);
                    $this->ip_model->setSubnetMask($subnet);
                    if($this->ip_model->validateIPPool()){
                       if( $this->ip_model->saveIPPool()){
                           $this->addToSubPool();
                       }
                    }
                    else echo '2';
                }
                else echo '0';
            }
        }
        else $this->load->view('login/login');
        }


//25 Jul 2012 :end

//26 Jul 2012:begin
//function to add /24 IP Blocks to Sub Primary Pool
//Further Subnetting Logic :-> Check Subnet Controller part !!!
public function addToSubPool() {
    if($this->session->userdata('Logged_In')){
        if (!isset($_SERVER['HTTP_X_REQUESTED_WITH'])){

            redirect('ip_controller/addIPPool');
        }

        else{
            $result = $this->ip_model->getLastFromIPPool();
            foreach($result as $row){
                $ip = ip2long($row->pool_values);
                $poolid = $row->pool_id;
                $subnetpool = $row->subnet;
            }

            $cidr = $subnetpool;
            $subnet = 24;           // The given CIDR IP Pool address is subnetted into /24 networks at once.

            $this->ip_model->setSubPoolSubnet($subnet);

            if ($ip == -1 || $ip === FALSE) {
                echo '0';
            }
            else {
                $mask = ip2long('255.255.255.255') << (32 - (int) $cidr);
                $network = ($ip & $mask);

                $length=1<<($subnet-$cidr);
                $d=1<<(32-$subnet);
                $ips=array();
                for($i=0;$i<=$length-1;$i++){
                    $t=$d*$i;
                    $ips[]=long2ip($network+$t);
                    $this->ip_model->setSubPoolValue($ips[$i]);
                    $this->ip_model->setPoolID( $poolid);
                    $this->ip_model->setSubnetMask($subnetpool);

                    $this->ip_model->addSubIPPool();
                }
                echo '1';
            }
        }
        }
        else $this->load->view('login/login');
    }



public function deleteIPPool(){
    if($this->session->userdata('Logged_In')){
        if (!isset($_SERVER['HTTP_X_REQUESTED_WITH'])){

            redirect('ip_controller/addIPPool');
        }

        else{
            $this->ip_model->setPoolID($this->input->post('ippool_id'));
            If($this->ip_model->checkSubPoolByUsingPoolID()){
                $this->ip_model->deleteMainIPPool();
                echo '1';
            }
            else echo '0';
        }
    }
    else $this->load->view('login/login');
}


//26 Jul 2012:end


    public function openPoolDetails( $offset=0){
        if($this->session->userdata('Logged_In')){
            if (!isset($_SERVER['HTTP_X_REQUESTED_WITH'])){

                redirect('ip_controller/addIPPool');
            }

            else{
        $pool_id = $this->input->post('ippool_id');
        $this->ip_model->setPoolID($pool_id);


        $config['base_url'] = base_url() . 'index.php/ip_controller/openPoolDetails/';
        $config['total_rows'] = count($this->ip_model->getMainSubPrimaryPool());
        $config['per_page'] = 16;

        $this->pagination->initialize($config);

        $jsFunction['name'] = 'open_PoolDetails_Retrieve';
        $jsFunction['params'] = array($pool_id);

        $this->pagination->initialize_js_function($jsFunction);

        $data['page_link'] = $this->pagination->create_js_links();
        $data['pool_value']= $this->ip_model->getPoolValueByID($pool_id);
//        $data['ip_mainsub_pools'] = $this->ip_model->getMainSubPrimaryPools($config['per_page'],$offset);
        $data['ip_mainsub_pools'] = $this->ip_model->getMainSubPrimaryPool();

        $this->load->view('ip/view_ip_mainsub_pools',$data);

            }
    }        else $this->load->view('login/login');
    }

}
?>