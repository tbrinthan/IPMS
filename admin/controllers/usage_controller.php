<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
 class Usage_controller extends CI_Controller{
     
     function __construct() {
         parent::__construct();
         $this->load->model('records_model');
         $this->load->model('usage_model');
     }
     
     public function node_usage(){
            if($this->session->userdata('Logged_In')) {
                $data['title']='Node Usage';
                $nodeips=$this->usage_model->get_nodeblocks();
                $data['nodeips']=$this->usage_model->get_nodeblocks();
                $temp=array();
                foreach($nodeips as $row){
                   $temp[$row->ip_id]=$this->node_percent_calculator($row->ip_id,$row->subnet);
                }
                $data['temp']=$temp;
                $partials=array('content'=>'records/node_usage');
                $this->template->load('template/simpla_template',$partials,$data);
            }
            else $this->load->view('login/login');
        }
     public function block_usage(){
            if($this->session->userdata('Logged_In')) {
                $data['title']='IP Block Usage';
                $ipblocks=$this->usage_model->get_primaryblocks();
                $data['ipblocks']=$this->usage_model->get_primaryblocks();   
                $temp=array();
                foreach($ipblocks as $row){
                   $temp[$row->parent_id]=$this->block_percent_calculator($row->parent_id);
                }
                $data['temp']=$temp;
                $partials=array('content'=>'records/block_usage');
                $this->template->load('template/simpla_template',$partials,$data);
            }
            else $this->load->view('login/login');
        }
        
        public function pool_usage(){
            if($this->session->userdata('Logged_In')) {
                $data['title']='IP Block Usage';
                $ippools=$this->usage_model->get_ippools();
                $data['ippools']=$this->usage_model->get_ippools();   
                $temp1=array();
                $temp2=array();
                $temp3=array();
                foreach ($ippools as $row){
                    $total=array_sum($this->pool_percent_calculator($row->pool_id));
                    $percent=round(($total/(1<<(24-$row->subnet))),2);
                    $temp1[$row->pool_id]=$percent;
                    $temp2[$row->pool_id]=$this->pool_percent_calculator($row->pool_id);
                    $temp3[$row->pool_id]=$this->pool_percent_calculator($row->pool_id);
                    $this->usage_model->setPoolid($row->pool_id);
  
                }          
                $data['temp1']=$temp1;
                $data['temp2']=$temp2;
                $data['temp3']=$temp3;
                $partials=array('content'=>'records/pool_usage');
                $this->template->load('template/simpla_template',$partials,$data);
            }
            else $this->load->view('login/login');
        }
        
     
     public function node_percent_calculator($id,$subnet){
         $this->usage_model->setNodeipid($id);
         $assigned=$this->usage_model->get_assigned_nodeip();
         $total=1<<(32-$subnet);
         $percent=round(($assigned/$total)*100,2);
         return $percent;
     }
     
     public function block_percent_calculator($id){
         $this->usage_model->setParentid($id);
         $n=sizeof($this->usage_model->get_assigned_nodeblocks());
         
         $c=$this->usage_model->get_assigned_catblocks();
         $subnet=array();
         foreach ($c as $row){
            $subnet[]= $row->catsubnet;
         }
         $cc=0;
         for($i=0;$i<count($subnet);$i++){
             $cc+=1<<(32-$subnet[$i]);
         }
         $t=$n+$cc;
         return round(($t/(1<<8))*100,2);     
     }
     
     public function pool_percent_calculator($id){
         $this->usage_model->setPoolid($id);
//         $result=$this->usage_model->get_assigned_blocks_parentip();
         $result=$this->usage_model->get_all_parentip();
         $temp=array();
         foreach ($result as $row){
             $temp[$row->parent_id]=$this->block_percent_calculator($row->parent_id);
//             $temp['sub_pool_values'.$row->parent_id]=$row->sub_pool_values;
         }
         return $temp;
     }
     
     public function test(){
         $ippools=$this->usage_model->get_ippools(); 
         $temp=array();
         foreach ($ippools as $row){
             $temp[$row->pool_id]=($this->pool_percent_calculator($row->pool_id));
         }
         var_dump($temp);
     }
     
     public function openchart(){
         $pool_id=$this->input->post('pool_id');
         
     }
     
 }
