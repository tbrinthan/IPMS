<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Nirosan
 * Date: 8/20/12
 * Time: 10:50 AM
 * Model for JOINING and SUBNETTING
 */
class Join_split_Model extends CI_Model{
    private $ip_id;
    private $subnet;
    private $ip_address;
    private $netbits;
    private $join;
    private $subpool_id;


    public function setIpId($ip_id)
    {
        $this->ip_id = $ip_id;
    }

    public function getIpId()
    {
        return $this->ip_id;
    }
    public function setIpAddress($ip_address)
    {
        $this->ip_address = $ip_address;
    }

    public function getIpAddress()
    {
        return $this->ip_address;
    }

    public function setSubnet($subnet)
    {
        $this->subnet = $subnet;
    }

    public function getSubnet()
    {
        return $this->subnet;
    }
    public function getNetbits() {
        return $this->netbits;
    }

    public function setNetbits($netbits) {
        $this->netbits = $netbits;
    }
    
    public function getJoin() {
        return $this->join;
    }

    public function setJoin($join) {
        $this->join = $join;
    }
    
    public function getSubpoolId() {
        return $this->subpool_id;
    }

    public function setSubpoolId($subpool_id) {
        $this->subpool_id = $subpool_id;
    }

        
        public function get_sub_pool_id(){
        $sql="SELECT sub_pool_id FROM nodeip WHERE ip_id=?";
        $Q=$this->db->query($sql,array($this->getIpId()));
        if($Q->num_rows()>0){
            foreach ($Q->result_array() as $row){
                $data= $row['sub_pool_id'];
            }
        }
        $Q->free_result();
        return $data;
    }
    
    public function get_pool_id(){
        $sql="SELECT pool_id FROM primary_sub_pool WHERE sub_pool_id=?";
        $Q=$this->db->query($sql,array($this->getSubpoolId()));
        if($Q->num_rows()>0){
            foreach ($Q->result_array() as $row){
                $data= $row['pool_id'];
            }
        }
        $Q->free_result();
        return $data;
    }
    public function get_category_details(){
        $sql="SELECT category_id,sub_category_id,sub_pool_id FROM category_ip WHERE ip_id=?";
        $Q=$this->db->query($sql,array($this->getIpId()));
        if($Q->num_rows()>0){
            foreach ($Q->result_array() as $row){
                $data['cat_id']= $row['category_id'];
                $data['subcat_id']= $row['sub_category_id'];
                $data['subpool_id']= $row['sub_pool_id'];
            }
        }
        $Q->free_result();
        return $data;
    }
    public function delete_nodeip(){
        $sql="DELETE FROM nodeip WHERE sub_category_id IS NULL AND status=false AND ip_id=?";
        $this->db->query($sql,array($this->getIpId()));
        return $this->db->affected_rows();
    }

    public function add_nodeip(){
        $sql="INSERT INTO nodeip VALUES (?,?,?,?,?,?,?,?,?)";
        $this->db->query($sql,array(1,null,$this->get_sub_pool_id(),null,$this->getIpAddress(),$this->getSubnet(),false,null,null));
        return $this->db->affected_rows();
//        return $sql;
    }


    public function delete_categoryip(){
        $sql="DELETE FROM category_ip WHERE customer_id IS NULL AND status=false AND ip_id=?";
        $this->db->query($sql,array($this->getIpId()));
        return $this->db->affected_rows();
    }

    public function add_categoryip(){
        $detail=$this->join_split_model->get_category_details();
//        $sql="INSERT INTO category_ip VALUES (".$detail['cat_id'].",".$detail['subcat_id'].",".$detail['subpool_id'].",null,".$this->getIpAddress().",".$this->getSubnet().",false,null,null,null)";
        $sql="INSERT INTO category_ip VALUES (?,?,?,?,?,?,?,?,?,?,?)";
        $this->db->query($sql,array($detail['cat_id'],$detail['subcat_id'],$detail['subpool_id'],null,$this->getIpAddress(),$this->getSubnet(),false,null,null,null,null));
        return $this->db->affected_rows();
//        return $sql;
    }

    public function node_join_availability(){
        $sql="SELECT * FROM nodeip WHERE ip_addresses=? AND subnet=? AND sub_category_id IS NULL AND status=false";
//        $sql="SELECT * FROM nodeip WHERE ip_addresses=".$this->getIpAddress()." AND subnet=".$this->getNetbits()." AND sub_category_id IS NULL AND status=false";
        $Q=$this->db->query($sql,array($this->getIpAddress(),$this->getNetbits()));
        if($Q->num_rows()==0){
            return 0;
        }else return 1;
        
//        return $sql;
    }
    
    public function category_join_availability(){
         $sql="SELECT * FROM category_ip WHERE ip_addresses=? AND subnet=? AND customer_id IS NULL AND status=false";
//        $sql="SELECT * FROM category_ip WHERE ip_addresses=".$this->getIpAddress()." AND subnet=".$this->getNetbits()." AND customer_id IS NULL AND status=false";
        $Q=$this->db->query($sql,array($this->getIpAddress(),$this->getNetbits()));
        if($Q->num_rows()==0){
            return 0;
        }else return 1;
        
//        return $sql;
    }

    public function primary_join_availability(){
        $sql="SELECT * FROM primary_sub_pool WHERE sub_pool_values=? AND subnet=? AND category_id IS NULL AND sub_category_id IS NULL AND status=false";
//        $sql="SELECT * FROM nodeip WHERE ip_addresses=".$this->getIpAddress()." AND subnet=".$this->getNetbits()." AND sub_category_id IS NULL AND status=false";
        $Q=$this->db->query($sql,array($this->getIpAddress(),$this->getNetbits()));
        if($Q->num_rows()==0){
            return 0;
        }else return 1;
        
//        return $sql;
    }

    public function get_location(){
        $sql="SELECT nodeip.ip_addresses,nodeip.subnet,nodeip.from_date,subcategory.ssid,subcategory.location FROM nodeip 
            LEFT JOIN subcategory ON nodeip.sub_category_id=subcategory.sub_category_id WHERE nodeip.ip_id=? AND status=true AND to_date IS NULL";
        $Q=$this->db->query($sql,array($this->getIpId()));
        return $Q;
//        return $sql;
    }
    
    public function delete_nodeblock(){
        $sql="DELETE FROM nodeip WHERE ip_addresses=? AND subnet=? AND status=false AND to_date IS NULL";
//        $sql="DELETE FROM nodeip WHERE ip_addresses=".$this->getIpAddress()." AND subnet=".$this->getNetbits()." AND status=false AND to_date IS NULL";
        $this->db->query($sql,array($this->getIpAddress(),  $this->getNetbits()));
        return $this->db->affected_rows();
//        return $sql;
    }
    
    public function join_nodeblock(){
        $sql="INSERT INTO nodeip VALUES(?,?,?,?,?,?,?,?,?)";
//        $sql="INSERT INTO nodeip VALUES (1,null,".$this->get_sub_pool_id().",null,".$this->getIpAddress().",".$this->getJoin().",false,null,null)";
        $this->db->query($sql,array(1,null,$this->get_sub_pool_id(),null,$this->getIpAddress(),$this->getJoin(),false,null,null));
        return $this->db->affected_rows();
//        return $sql;
        
    }
    
     public function delete_categoryblock(){
        $sql="DELETE FROM category_ip WHERE ip_addresses=? AND subnet=? AND status=false AND to_date IS NULL";
//        $sql="DELETE FROM nodeip WHERE ip_addresses=".$this->getIpAddress()." AND subnet=".$this->getNetbits()." AND status=false AND to_date IS NULL";
        $this->db->query($sql,array($this->getIpAddress(),  $this->getNetbits()));
        return $this->db->affected_rows();
//        return $sql;
    }
    
    public function join_categoryblock(){
        $detail=$this->join_split_model->get_category_details();
        $sql="INSERT INTO category_ip VALUES(?,?,?,?,?,?,?,?,?,?,?)";
//       $sql="INSERT INTO category_ip VALUES (".$detail['cat_id'].",".$detail['subcat_id'].",".$detail['subpool_id'].",null,".$this->getIpAddress().",".$this->getJoin().",false,null,null,null)";
        $this->db->query($sql,array($detail['cat_id'],$detail['subcat_id'],$detail['subpool_id'],null,$this->getIpAddress(),$this->getJoin(),false,null,null,null,null));
        return $this->db->affected_rows();
//        return $sql;
        
    }
    
   public function delete_primaryblock(){
        $sql="DELETE FROM primary_sub_pool WHERE sub_pool_values=? AND subnet=? AND status=false AND category_id IS NULL AND sub_category_id IS NULL";
//        $sql="DELETE FROM primary_sub_pool WHERE sub_pool_values=".$this->getIpAddress()." AND subnet=".$this->getNetbits()." AND status=false AND category_id IS NULL AND sub_category_id IS NULL";
        $this->db->query($sql,array($this->getIpAddress(),  $this->getNetbits()));
        return $this->db->affected_rows();
//        return $sql;
    }
    
    public function join_primaryblock(){
        $sql1="INSERT INTO primary_sub_pool VALUES(?,?,?,?,?,?,?,?)";
//        $sql1="INSERT INTO primary_sub_pool VALUES (".$this->get_pool_id().",null,".$this->getIpAddress().",".$this->getJoin().",null,null,false,-1)";
        $this->db->query($sql1,array($this->get_pool_id(),null,$this->getIpAddress(),$this->getJoin(),null,null,false,-1));
        $sql2 = "UPDATE primary_sub_pool SET primary_sub_pool.parent_id = sub_pool_id WHERE primary_sub_pool.parent_id=-1";
        $this->db->query($sql2);
        return $this->db->affected_rows();
//        return $sql2;
        
    }

}
?>