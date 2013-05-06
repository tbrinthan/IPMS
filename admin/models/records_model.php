<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Nirosan
 * Date: 8/28/12
 * Time: 11:55 AM
 * To change this template use File | Settings | File Templates.
 */
class Records_model extends CI_Model{
    
    private $customer_id;
    private $ip_search;
    
    public function getCustomerId() {
        return $this->customer_id;
    }

    public function setCustomerId($customer_id) {
        $this->customer_id = $customer_id;
    }
    
    public function setIpSearch($ip_search)
    {
        $this->ip_search = $ip_search;
    }

    public function getIpSearch()
    {
        return $this->ip_search;
    }

    
    function get_customer_details(){
        $sql = "SELECT * FROM customers";
        $Q = $this->db->query($sql);
        return $Q->result();
    }
    
    function get_customer_node(){
        $sql="SELECT node_detail.node_detail_id,node_type.type_name,subcategory.ssid,subcategory.location,node_detail.ip_addresses,node_detail.parent_subnet,
            node_detail.from_date,node_detail.to_date,node_detail.remarks FROM node_detail LEFT JOIN (nodeip LEFT JOIN subcategory ON nodeip.sub_category_id=subcategory.sub_category_id) ON
            node_detail.nodeip_id=nodeip.ip_id LEFT JOIN node_type ON node_detail.type_id=node_type.type_id
            WHERE customer_id=? ORDER BY node_detail.from_date,node_detail.to_date asc";
        $Q=$this->db->query($sql,array($this->getCustomerId()));
        return $Q->result();
    }
    
    function get_customer_category(){
        $sql="SELECT category_ip.ip_id,category.category_name,subcategory.ssid,category_ip.ip_addresses,category_ip.subnet,category_ip.from_date,
            category_ip.to_date,category_ip.remarks FROM category_ip LEFT JOIN category ON category_ip.category_id=category.category_id LEFT JOIN subcategory
            ON category_ip.sub_category_id=subcategory.sub_category_id WHERE category_ip.customer_id=? ORDER BY category_ip.from_date,category_ip.to_date asc";
        $Q=$this->db->query($sql,array($this->getCustomerId()));
        return $Q->result();
    }
    
    function get_customer_private(){
        $sql="SELECT 'Private IP' as category_name,pvt_ip_id,ip_addresses,subnet,from_date,to_date,remarks FROM private_ip WHERE customer_id=? ORDER BY from_date,to_date asc";
        $Q=$this->db->query($sql,array($this->getCustomerId()));
        return $Q->result();
    }

    function get_customer_byId(){
        $sql = "SELECT * FROM customers WHERE customer_id = ?";
        $Q = $this->db->query($sql,array($this->getCustomerId()));
        return $Q->result();
    }

    function searchNodeIP(){
        $sql = "SELECT customers.status AS cust_status,customers.customer_name,customers.customer_id,customers.from_date AS cust_from_date,customers.end_date AS cust_to_date,nodeip.subnet,nodeip.category_id,nodeip.sub_category_id,nodeip.from_date AS node_from_date,nodeip.to_date AS node_to_date,nodeip.ip_id,nodeip.ip_addresses AS nodeip_add, node_detail.ip_addresses,node_detail.customer_id,node_detail.to_date,node_detail.from_date,node_detail.parent_subnet,node_detail.remarks,subcategory.location_id,subcategory.location
         FROM nodeip LEFT JOIN node_detail ON nodeip.ip_id = node_detail.nodeip_id LEFT JOIN customers ON customers.customer_id = node_detail.customer_id LEFT JOIN subcategory ON subcategory.sub_category_id = nodeip.sub_category_id WHERE nodeip.ip_addresses LIKE '%".$this->getIpSearch()."%' OR node_detail.ip_addresses LIKE '%".$this->getIpSearch()."%' ORDER BY node_detail.from_date,node_detail.to_date asc";
        $result = $this->db->query($sql);
        return ($result->result());
    }

    function searchCategoryIP(){
        $sql = "SELECT customers.status AS cust_status,customers.customer_name,customers.customer_id,customers.from_date AS cust_from_date,customers.end_date AS cust_to_date,category_ip.*,subcategory.sub_category_id,subcategory.ssid FROM category_ip LEFT JOIN subcategory ON subcategory.sub_category_id = category_ip.sub_category_id LEFT JOIN customers ON customers.customer_id = category_ip.customer_id WHERE category_ip.ip_addresses LIKE '%".$this->getIpSearch()."%' ORDER BY category_ip.from_date,category_ip.to_date asc";
        $result = $this->db->query($sql);
        return ($result->result());
    }

    function searchPrivateIP(){
        $sql = "SELECT customers.status AS cust_status,customers.customer_name,customers.customer_id,customers.from_date AS cust_from_date,customers.end_date AS cust_to_date,private_ip.* FROM private_ip LEFT JOIN customers ON customers.customer_id = private_ip.customer_id WHERE private_ip.ip_addresses LIKE '%".$this->getIpSearch()."%'ORDER BY private_ip.from_date,private_ip.to_date asc";
        $result = $this->db->query($sql);
        return ($result->result());
    }

   


}

?>
