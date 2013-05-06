<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Login_controller extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('login_model');
        $this->load->model('user_model');
    }

    public function index() {
        if ($this->session->userdata('Logged_In'))
            redirect('login_controller/view_home');
        else
            $this->load->view('login/login');
    }

    public function view_dashboard() {
        if ($this->session->userdata('Logged_In')) {
            $data['title'] = "Home";
            $partials = array('content' => 'home');
            $this->template->load('template/simpla_template', $partials, $data);
        }
        else
            $this->load->view('login/login');
    }

    public function view_home() {
        if ($this->session->userdata('Logged_In')) {
            $data['title'] = "Search";
            $partials = array('content' => 'search/search');
            $this->template->load('template/simpla_template', $partials, $data);
        }
        else
            $this->load->view('login/login');
    }

    public function login_in() {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $this->login_model->setUsername($username);
        $this->login_model->setPassword(md5($password));

        if ($this->login_model->logging_in()) {
            $this->__set_session();
            echo '1';
        } else {
            $user_data = array
                (
                'User_ID' => null,
                'User_Type' => null,
                'Name' => null,
                //   'Email'  => null,
                //    'Company_ID'  => null,
                //    'Estate_ID'     => null,F
                'Logged_In' => false
            );

            $this->session->set_userdata($user_data);

            echo '0';
        }
    }

    private function __set_session() {
        $row = $this->login_model->set_session();
        // $logged_id = $this->Login_model->addUserlogg($row['USER_ID'],$_SERVER['REMOTE_ADDR'],$_SERVER['HTTP_USER_AGENT']);

        $user_data = array
            (
            'User_ID' => $row['user_id'],
            'User_Type' => $row['group_id'],
            'Name' => $row['username'],
            //    'Company_ID'  => $row['COMPANY_ID'],
            //   'Estate_ID'     => $row['ESTATE_ID'],
            //   'logged_id'  => $logged_id,
            'Logged_In' => TRUE
        );
        $this->session->set_userdata($user_data);
    }

    public function logout() {
        $user_data = array
            (
            'User_ID' => null,
            'User_Type' => null,
            'Name' => null,
            //   'logged_id'  => null,
            'Logged_In' => false
        );

        $this->session->set_userdata($user_data);

        redirect('login_controller');
    }

    public function reset_password_email() {

        $this->login_model->setEmail($this->input->post('email'));
        $chkEmail = $this->login_model->check_email_for_resetpwd();
        if (empty($chkEmail)) {

            echo 0;
            //echo random_string('alnum', 32);
        } else {
//            echo 1;
            $token=sha1($chkEmail['user_id'].$chkEmail['username'].$chkEmail['password']);
            $this->user_model->setUserId($chkEmail['user_id']);
            $this->user_model->setToken($token);
            if($this->user_model->add_token()){
              echo 1;
//            $to = $chkEmail['email'];
//            $subject = 'RESET YOUR PASSWORD';
//            $message = "
//            <html>
//            <head>
//            <title>Password Reset</title>
//            </head>
//            <body>
//            <p>
//            	MR ".$chkEmail['fullname'].",<br></br> Username: <b>".$chkEmail['username']."</b><br></br> Follow the below link to reset your password.<br></br>
//            	<a href='".site_url()."/login_controller/reset_password/".$token."'>".site_url()."/login_controller/reset_password/".$token."</a>
//            	
//            </p>
//            </body>
//            </html>";
//
//            $headers = 'MIME-Version: 1.0' . "\r\n" .
//            		'Content-type: text/html; charset=iso-8859-1' . "\r\n" .
//            		'From: webmaster@example.com' . "\r\n" .
//                       'Reply-To: webmaster@example.com' . "\r\n" .
//                       'X-Mailer: PHP/' . phpversion();
//            echo mail($to, $subject, $message, $headers);
            }
            else echo "Error while sending mail";

        }
    }
    
      public function reset_password($token){
        if(($this->user_model->check_token($token))==1){
            $data['token']=$token;
            $data['title']='Reset your Password';
            $partials=array('content'=>'users/reset_password');
            $this->template->load('template/simpla_template_1', $partials,$data);
        }else{
            show_404();
        }
    }
    
    public function reset_pwd(){
        $this->user_model->setToken($this->input->post('token'));
        $this->user_model->setPwd(md5($this->input->post('new_resetpwd')));
        if($this->user_model->reset_password()){
            echo 1;
        }else echo 0;
   }

   public function test(){
    $array1=array('1','2','3','4');
    $array2=array('2');
    foreach ($array1 as $row1){
        foreach ($array2 as $row2){
//            for($i=0;$row1[$i]==$row2[$i];$i++){
//                echo $array1[$i];
//            }
        }
    }
        echo 'hello';
}

public function test1(){
$this->logToFile('a.txt', 'High temperature');

}
public function logToFile($filename, $msg)
{ 
// open file
$fd = fopen($filename, "a");
// append date/time to message
$str = "[" . date("Y/m/d h:i:s", mktime()) . "] " . $msg; 
// write string
fwrite($fd, $str . "\n");
// close file
fclose($fd);
}


}



/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
?>