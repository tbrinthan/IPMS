<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Nirosan
 * Date: 8/20/12
 * Time: 10:47 AM
 * Controller for JOINING and SUB NETTING
 *
 * Main functions:
 * *subnet_calculator($ip,$netbits,$subnet);*
 * 1.Using the netbits mask will be generated.
 * 2.Using ip and mask network address will be generated.
 * 3.Length is calculated using the netbits and subnet value.
 * 4.Then ips will be generated incrementing from network address upto it's length.
 *
 **join_calculator($ip,$netbits,$join);*
 * 1.Input should be a network, it is tested. But since we are selecting and joining
 * it's not needed.
 * 2.Loop through the consecutive network addresses of given network and get the network which
 * is divisible by join bits.
 * 3.The previous address from the fetched address will be the joined network.
 * 4.By subnetting the joined network using given network's netbits we can generate
 * the network addresses needed to join.
 */
Class Join_split_Controller extends CI_Controller{

    function __construct(){
        parent::__construct();
        $this->load->model('join_split_model');
    }

//display the interface for join/split
    function join_split_view(){
        if ($this->session->userdata('Logged_In')) {
            $data['title'] = "JOIN & SPLIT Networks";
            $partials = array('content' => 'ip/join_split');
            $this->template->load('template/simpla_template', $partials, $data);
        }
        else
            $this->load->view('login/login');
    }

//fetch data to display node ips as datatable.
    function node_datatable(){
        $this->load->library('datatables');
        $this->datatables->select('ip_id,ip_addresses,subnet,status');
        $array=array('to_date'=>null );
        $this->datatables->from('nodeip');
        $this->datatables->where($array);
        $this->datatables->add_column('','','');
        $this->datatables->add_column('','','');
        echo $this->datatables->generate();
     }

//method to subnet Node blocks.
    function node_subnet(){

        $ip_id=$this->input->post('id');
        $ip=$this->input->post('ip_add');
        $netbits=$this->input->post('netbits');
        $subnet=$this->input->post('subnet');
        $this->join_split_model->setIpId($ip_id);
        $ip_addresses=$this->subnet_calculator($ip,$netbits,$subnet);
        if($ip_id!=null){
            for($i=0;$i<count($ip_addresses);$i++){
                $this->join_split_model->setSubnet($subnet);
                $this->join_split_model->setIpAddress($ip_addresses[$i]);
                $this->join_split_model->add_nodeip();
            }
            if($this->join_split_model->delete_nodeip()){
                echo 'Node block is subnetted successfully';
            }
        }

    }

//method to join node blocks
    function node_join(){

        $ip_id=$this->input->post('id');
        $ip=$this->input->post('ip_add');
        $netbits=$this->input->post('netbits');
        $join=$this->input->post('join');
        $this->join_split_model->setIpId($ip_id);
        $this->join_split_model->setNetbits($netbits);
        $this->join_split_model->setJoin($join);

        $temp=array();

        list($ips,$joinedip)=$this->join_calculator($ip,$netbits,$join);
        for($i=0;$i<count($ips);$i++){
            
            $this->join_split_model->setIpAddress($ips[$i]);

            //check whether all the addresses needed to join are free.
            if(!($this->join_split_model->node_join_availability())){
                $temp[]=$ips[$i];//fetch the addresses that are not available
            }
        }
        if(!empty($temp)){

        ?>
           <h3 style="color: red">Cannot Be Joined as <?php echo $joinedip.'/'.$join?> NETWORK</h3>
           <p>
               The Following Networks are not available.<br />
               <?php for($i=0;$i<count($temp);$i++){?>
               <strong><?php echo $temp[$i].'/'.$netbits?></strong><br/>
               <?php }?>
           </p>
            <?php
        }
        else{
           $this->join_split_model->setIpAddress($joinedip);
           $this->join_split_model->join_nodeblock();
            for($i=0;$i<count($ips);$i++){
                $this->join_split_model->setIpAddress($ips[$i]);
                $this->join_split_model->setNetbits($netbits);
                $this->join_split_model->delete_nodeblock();  
            }
          
          
           ?>
           <h3>JOIN AS <?php echo $joinedip.'/'.$join?> NETWORK</h3>
           <p>
               The Following Networks are joined.<br />
               <?php for($i=0;$i<count($ips);$i++){?>
               <strong><?php echo $ips[$i].'/'.$netbits?></strong><br/>
               <?php }?>
           </p>
            <?php
        }

    }

//fetch data to display category ips as datatable.
    function category_datatable(){

        $array=array('to_date'=>null );
        $this->load->library('datatables');
        $this->datatables->select('ip_id,category_name,ssid,ip_addresses,subnet,status,customer_id');
        $this->datatables->from('category_ip');
        $this->datatables->join('category', 'category_ip.category_id = category.category_id', 'left');
        $this->datatables->join('subcategory', 'category_ip.sub_category_id = subcategory.sub_category_id', 'left');
        $this->datatables->where($array);
        $this->datatables->add_column('','','');
        $this->datatables->add_column('','','');
        echo $this->datatables->generate();
    }

//method to subnet category ip blocks
    function category_subnet(){

        $ip_id=$this->input->post('id');
        $ip=$this->input->post('ip_add');
        $netbits=$this->input->post('netbits');
        $subnet=$this->input->post('subnet');
        $this->join_split_model->setIpId($ip_id);
        $ip_addresses=$this->subnet_calculator($ip,$netbits,$subnet);
        if($ip_id!=null){
            for($i=0;$i<count($ip_addresses);$i++){
                $this->join_split_model->setSubnet($subnet);
                $this->join_split_model->setIpAddress($ip_addresses[$i]);
                $this->join_split_model->add_categoryip();
            }
            if($this->join_split_model->delete_categoryip()){
                echo 'Category Block is subnetted successfully';
            }
        }


    }

//method to join category ip blocks
    function category_join(){

        $ip_id=$this->input->post('id');
        $ip=$this->input->post('ip_add');
        $netbits=$this->input->post('netbits');
        $join=$this->input->post('join');
        $this->join_split_model->setIpId($ip_id);
        $this->join_split_model->setNetbits($netbits);
        $this->join_split_model->setJoin($join);

        $temp=array();

        list($ips,$joinedip)=$this->join_calculator($ip,$netbits,$join);
        for($i=0;$i<count($ips);$i++){
            
            $this->join_split_model->setIpAddress($ips[$i]);
            if(!($this->join_split_model->category_join_availability())){
                $temp[]=$ips[$i];
            }
        }
        if(!empty($temp)){

        ?>
           <h3 style="color: red">Cannot Be Joined as <?php echo $joinedip.'/'.$join?> NETWORK</h3>
           <p>
               The Following Networks are not available.<br />
               <?php for($i=0;$i<count($temp);$i++){?>
               <strong><?php echo $temp[$i].'/'.$netbits?></strong><br/>
               <?php }?>
           </p>
            <?php
        }
        else{
           $this->join_split_model->setIpAddress($joinedip);
           $this->join_split_model->join_categoryblock();
            for($i=0;$i<count($ips);$i++){
                $this->join_split_model->setIpAddress($ips[$i]);
                $this->join_split_model->setNetbits($netbits);
                $this->join_split_model->delete_categoryblock();
            }
          
          
           ?>
           <h3>JOIN AS <?php echo $joinedip.'/'.$join?> NETWORK</h3>
           <p>
               The Following Networks are joined.<br />
               <?php for($i=0;$i<count($ips);$i++){?>
               <strong><?php echo $ips[$i].'/'.$netbits?></strong><br/>
               <?php }?>
           </p>
            <?php
        }

    }

//fetch data to display primary sub pool ips as datatable.
     function primary_datatable(){
        $this->load->library('datatables');
        $this->datatables->select('sub_pool_id,sub_pool_values,subnet,status');
        $array=array('subnet !='=> 24,'status'=>0);
        $this->datatables->from('primary_sub_pool');
        $this->datatables->where($array);
        $this->datatables->add_column('','','');
        $this->datatables->add_column('','','');
        echo $this->datatables->generate();
     }

//method to join primary sub pool values
    function primary_join(){

        $subpool_id=$this->input->post('id');
        $ip=$this->input->post('ip_add');
        $netbits=$this->input->post('netbits');
        $join=$this->input->post('join');
        $this->join_split_model->setSubpoolId($subpool_id);
        $this->join_split_model->setNetbits($netbits);
        $this->join_split_model->setJoin($join);

        $temp=array();

        list($ips,$joinedip)=$this->join_calculator($ip,$netbits,$join);
        for($i=0;$i<count($ips);$i++){
            
            $this->join_split_model->setIpAddress($ips[$i]);
            if(!($this->join_split_model->primary_join_availability())){
                $temp[]=$ips[$i];
            }
        }
        if(!empty($temp)){

        ?>
           <h3 style="color: red">Cannot Be Joined as <?php echo $joinedip.'/'.$join?> NETWORK</h3>
           <p>
               The Following Networks are not available.<br />
               <?php for($i=0;$i<count($temp);$i++){?>
               <strong><?php echo $temp[$i].'/'.$netbits?></strong><br/>
               <?php }?>
           </p>
            <?php
        }
        else{
           $this->join_split_model->setIpAddress($joinedip);
          echo $this->join_split_model->join_primaryblock();
            for($i=0;$i<count($ips);$i++){
                $this->join_split_model->setIpAddress($ips[$i]);
                $this->join_split_model->setNetbits($netbits);
             echo   $this->join_split_model->delete_primaryblock();  
            }

           ?>
           <h3>JOIN AS <?php echo $joinedip.'/'.$join?> NETWORK</h3>
           <p>
               The Following Networks are joined.<br />
               <?php for($i=0;$i<count($ips);$i++){?>
               <strong><?php echo $ips[$i].'/'.$netbits?></strong><br/>
               <?php }?>
           </p>
            <?php
        }

    }

    
    
    
//method to calculate subnet: procedure is stated at start of the page
    public function subnet_calculator($ip,$netbits,$subnet) {
        $ip = ip2long($ip);
        if ($ip == -1 || $ip === FALSE) {
            echo "Invalid address, please try again.";
        } else {

            $mask = ip2long('255.255.255.255') << (32 - (int) $netbits);
            $network = ($ip & $mask);
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

//method to calculate joinable ips: procedure is stated at start of the page

    public function join_calculator($ip,$netbits,$join){

            $ip = ip2long($ip);
            $length1=1<<(32-$netbits);//No of hosts in the given network
            $length2=1<<(32-$join);//No of hosts in the joined network
            $mask = ip2long('255.255.255.255') << (32 - (int) $netbits);
            $network = ($ip & $mask);

            if ($ip == -1 || $ip === FALSE) {
                echo "Invalid address, please try again.";
            } else {
                //check join bits is less than netbits and prevent joining less than /24 network.
                if(((int)$join >= 24) && ((int)$join < (int)$netbits)){
                    if($ip==$network){
                        $t=$ip;
                        for($i=0;$i<=$length2;$i++){
                            $t+=$length1;
                            if($t%$length2==0){
                                break;
                            }
                        }
                        $newip=long2ip($t-$length2);
                        $newnetbits=$join;
                        $newsubnet=$netbits;
                        $ip_addresses=$this->subnet_calculator($newip,$newnetbits,$newsubnet);
                        return array($ip_addresses,$newip);

                    }else echo "Invalid network Address to join!!!";

                }else
                    echo "Joined network only can be less than /$netbits and greater than or equal to /24";
            }
    }

//method to show the details of a specific node ip.
     public function open_location_details() {
        $ip_id = $this->input->post('id');
        $this->join_split_model->setIpId($ip_id);
        $details = $this->join_split_model->get_location();
        $data=array();
        foreach ($details->result() as $row) {
            $data['ip_add'] = $row->ip_addresses;
            $data['subnet'] = $row->subnet;
            $data['location'] = $row->location;
            $data['ssid'] = $row->ssid;
            $data['date'] = $row->from_date;
        }
        if(!empty($data)){
        ?>
            <h3>Node Details.</h3><hr>
            <p>
                <strong>IP Block: </strong><?=$data['ip_add']?>/<?=$data['subnet']?><br/>
                <strong>Location & SSID: </strong><?=$data['location']?> & <?=$data['ssid']?><br/>
                <strong>Date Assigned: </strong><?php echo $data['date'] ?><br />
                <strong>Assigned by: </strong>
            </p>
        <?php }
        else echo 0;   
    }
}
?>