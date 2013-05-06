<?php

class Login_Model extends CI_Model{
    private $USERNAME,$PASSWORD,$EMAIL;
       function __construct(){
           parent::__construct();       }

        function getUsername(){return $this->USERNAME;}
        function getPassword(){return $this->PASSWORD;}
        function getEmail(){return $this->EMAIL;}
        function setUsername($x){ $this->USERNAME = $x;}
        function setPassword($x){ $this->PASSWORD = $x;}
        function setEmail($x){ $this->EMAIL = $x;}

        function getUser(){
            $query = $this->db->get('users');
            if ($query->num_rows() > 0) {
                foreach ($query->result() as $row) {
                    return array(
                        $row->Username,
                        $row->Password,
                        $row->Email,
                        $row->Contactno
                    );
                }
            }
        }

    function logging_in(){
        $sql = "SELECT * FROM users WHERE username = ? AND password = ?";
        $results = $this->db->query($sql,array($this->getUsername(),$this->getPassword()));
        if($results->num_rows() != 1) return 0;
        else  return 1;
    }
    
    function addUserlogg($USER_ID,$USER_IP_ADDRESS,$USER_BROWSER){			
        $sql = "INSERT INTO user_login_logs VALUES(?,?,?,?)";
        $results = $this->db->query($sql,array(NULL,$USER_ID,$USER_IP_ADDRESS,$USER_BROWSER));
        return $this->db->insert_id();
    }
    function set_session(){
        $sql = "SELECT * FROM users WHERE username =?";
        $results = $this->db->query($sql,array($this->getUsername()));
        $row = $results->row_array();
        return $row;
    }
    
    function check_email_for_resetpwd(){
            $sql="SELECT * FROM users WHERE email=?";
            $Q=$this->db->query($sql,array($this->getEmail()));
            return $Q->row_array();
        }
}

?>