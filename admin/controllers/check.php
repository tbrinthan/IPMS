<?php
/**
 * Created by JetBrains PhpStorm.
 * User: DELL
 * Date: 7/13/12
 * Time: 4:58 PM
 * To change this template use File | Settings | File Templates.
 */
class Check extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->model('login_model');
    }
    public function checker(){

        $username = "general1";
        $password = "hello";

       $this->login_model->setUsername($username);
       $this->login_model->setPassword($password);
       if( $this->login_model->logging_in()) echo "Success";

    }
}

?>