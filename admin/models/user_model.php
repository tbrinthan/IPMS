<?php

class user_model extends CI_Model {

    private $user_type;
    private $user_id;
    private $full_name;
    private $user_name;
    private $pwd;
    private $email;
    private $token;

    function __construct() {
        parent::__construct();
    }

    public function setFullName($full_name) {
        $this->full_name = $full_name;
    }

    public function getFullName() {
        return $this->full_name;
    }

    public function setUserName($user_name) {
        $this->user_name = $user_name;
    }

    public function getUserName() {
        return $this->user_name;
    }

    function setEmail($email) {
        $this->email = $email;
    }

    function getEmail() {
        return $this->email;
    }

    function setPwd($pwd) {
        $this->pwd = $pwd;
    }

    function getPwd() {
        return $this->pwd;
    }

    function setUserId($user_id) {
        $this->user_id = $user_id;
    }

    function getUserId() {
        return $this->user_id;
    }

    function setUserType($user_type) {
        $this->user_type = $user_type;
    }

    function getUserType() {
        return $this->user_type;
    }
    
    function setToken($token) {
        $this->token = $token;
    }

    function getToken() {
        return $this->token;
    }
    

    function get_users() {
        $data = array();
        $sql = "SELECT users.user_id,users.fullname,users.username, usergroup.group_name, users.email FROM users INNER JOIN usergroup ON users.group_id=usergroup.group_id ORDER BY users.user_id;";
        $Q = $this->db->query($sql);
        if ($Q->num_rows() > 0) {
            foreach ($Q->result_array() as $row) {
                $data[] = $row;
            }
        }
        $Q->free_result();
        return $data;
    }

    function get_user_data() {
        $sql = "SELECT * FROM users WHERE user_id=?";
        $Q = $this->db->query($sql, array($this->getUserId()));
        return $Q;
    }

    function get_user_types() {
        $sql = "SELECT * FROM usergroup";
        $Q = $this->db->query($sql);
        return $Q;
    }

    function delete_user() {
        $sql = "DELETE FROM users WHERE user_id = ?";
        $this->db->query($sql, array($this->getUserId()));
        return $this->db->affected_rows();
    }

    function check_email() {
        $sql = "SELECT * FROM users WHERE email=?";
        $Q = $this->db->query($sql, array($this->getEmail()));
        return $Q->num_rows();
    }

    function save_user() {
        $sql = "INSERT INTO users(group_id,fullname,username,password,email,token) VALUES(?,?,?,?,?,?)";
        $this->db->query($sql, array($this->getUserType(),
            $this->getFullName(),
            $this->getUserName(),
            $this->getPwd(),
            $this->getEmail(),NULL));
        return $this->db->affected_rows();
    }

    function update_user() {
        $sql = "UPDATE users SET group_id=?,fullname=?,username=?,email=?,token=? WHERE user_id=?";
        $this->db->query($sql, array($this->getUserType(),
            $this->getFullName(),
            $this->getUserName(),
            $this->getEmail(),
            $this->getUserId(),NULL));

        return $this->db->affected_rows();
    }

    function check_username() {
        $sql = "SELECT * FROM users WHERE username=?";
        $Q = $this->db->query($sql, array($this->getUserName()));
        return $Q->num_rows();
    }

    function change_newpwd() {
        $sql = "UPDATE users SET password=? WHERE user_id=?";
        $res = $this->db->query($sql, array($this->getPwd(), $this->getUserId()));
        return $res;
    }

    function check_oldpwd() {

        $sql = "SELECT * FROM users WHERE password=? AND user_id=?";
        $res = $this->db->query($sql, array($this->getPwd(), $this->getUserId()));
        return $res->num_rows();
    }
    
    function add_token(){
        $sql = "UPDATE users SET token=? WHERE user_id=?";
        $Q = $this->db->query($sql, array($this->getToken(), $this->getUserId()));
        return $Q;
    }
    
    function check_token($token){
        $sql = "SELECT * FROM users WHERE token=?";
        $Q=$this->db->query($sql,array($token));
        return $Q->num_rows();
    }
    
    function reset_password(){
        $sql = "UPDATE users SET password=?,token=? WHERE token=?";
        $Q = $this->db->query($sql, array($this->getPwd(),null,$this->getToken()));
        return $Q;
    }

}

?>