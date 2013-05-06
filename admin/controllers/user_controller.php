<?php
class User_controller extends CI_Controller{

    function __construct(){
        parent::__construct();
        $this->load->model('user_model');

    }

    public function index(){
        if($this->session->userdata('Logged_In')) {
            $this->load->model('user_model');
        }
        else $this->load->view('login/login');
    }

    public function add_user(){
        if($this->session->userdata('Logged_In')){
            $data['title']='IP Management System';
            $data['user_types']=$this->user_model->get_user_types();
            $partials=array('content'=>'users/add_user');
            $this->template->load('template/simpla_template', $partials,$data);
        }
        else{
            $this->load->view('login/login');
        }

    }

    public function save_user(){
        $this->user_model->setUserType($this->input->post('u_type'));
        $this->user_model->setFullName($this->input->post('f_name'));
        $this->user_model->setUserName($this->input->post('u_name'));
        $this->user_model->setPwd(md5($this->input->post('pwd')));
        $this->user_model->setEmail($this->input->post('email'));
        $result1=$this->user_model->check_email();
        $result2=$this->user_model->check_username();
        if($result1 == 0 && $result2 == 0){            
                echo $this->user_model->save_user();  
//            echo 1;
        }else if($result1 !=0){
            echo 0;
        }if($result2 !=0){echo 2;}
    }

    public function manage_user(){
//            $this->load->model('user_model');
        if($this->session->userdata('Logged_In')){
            $data['title']='IP Management System';
            $partials=array('content'=>'users/manage_user');
            $this->template->load('template/simpla_template', $partials,$data);
        }
        else $this->load->view('login/login');
    }

    public function delete_user(){

        $this->user_model->setUserId($this->input->post('user_id'));
        echo $this->user_model->delete_user();
    }

    public function edit_user($user_id){
        $this->user_model->setUserId($user_id);
        $data['title']='IP Management System';
        $data['detail']='Edit details of '.$this->user_model->get_user_data()->row()->username;
        $data['user_types']=$this->user_model->get_user_types();
        $query=$this->user_model->get_user_data();
        foreach($query->result() as $row){
            $data['user_id']=$row->user_id;
            $data['group_id']=$row->group_id;
            $data['fullname']=$row->fullname;
            $data['username']=$row->username;
            $data['email']=$row->email;
        }

        $partials=array('content'=>'users/edit_user');
        $this->template->load('template/simpla_template',$partials,$data);
//        echo $user_id;

    }



    public function update_user(){
        $this->user_model->setUserId($this->input->post('user_id'));
        $this->user_model->setUserType($this->input->post('u_type'));
        $this->user_model->setFullName($this->input->post('f_name'));
        $this->user_model->setUserName($this->input->post('u_name'));
        $this->user_model->setEmail($this->input->post('email'));
        echo $this->user_model->update_user();
    }

    public function check_username(){
        $this->user_model->setUserName($this->input->post('u_name'));
        $result=$this->user_model->check_username();
        if($result == 0){
            echo 'OK';
        }else{
            echo '<font color="red">The username <STRONG>'.$this->user_model->getUserName().'</STRONG> is already in use.</font>';
        }
    }
    
    public function change_password(){
        if($this->session->userdata('Logged_In')){
            $data['title']='Change Password';
            $partials=array('content'=>'users/change_password');
            $this->template->load('template/simpla_template', $partials,$data);
        }
        else{
            $this->load->view('login/login');
        }

    }

}
?>