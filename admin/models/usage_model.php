<?php

class Usage_model extends CI_Model {

    private $nodeipid;
    private $parentid;
    private $poolid;

    public function getParentid() {
        return $this->parentid;
    }

    public function setParentid($parentid) {
        $this->parentid = $parentid;
    }

    public function getNodeipid() {
        return $this->nodeipid;
    }

    public function setNodeipid($nodeipid) {
        $this->nodeipid = $nodeipid;
    }

    public function getPoolid() {
        return $this->poolid;
    }

    public function setPoolid($poolid) {
        $this->poolid = $poolid;
    }

    function get_nodeblocks() {
        $sql = "SELECT nodeip.*,subcategory.ssid FROM nodeip LEFT JOIN subcategory ON subcategory.sub_category_id=nodeip.sub_category_id WHERE to_date IS NULL";
        $Q = $this->db->query($sql);
        return $Q->result();
    }

    function get_assigned_nodeip() {
        $sql = "SELECT * FROM node_detail WHERE nodeip_id=? AND customer_id IS NOT NULL AND to_date IS NULL";
        $Q = $this->db->query($sql, array($this->getNodeipid()));
        return $Q->num_rows();
    }

    function get_primaryblocks() {
        $sql = "SELECT * FROM primary_sub_pool WHERE subnet=24 GROUP BY sub_pool_values";
        $Q = $this->db->query($sql);
        return $Q->result();
    }

    function get_assigned_nodeblocks() {
        $sql = "SELECT * FROM primary_sub_pool LEFT JOIN ( nodeip
                LEFT JOIN node_detail ON nodeip.ip_id = node_detail.nodeip_id) ON primary_sub_pool.sub_pool_id = nodeip.sub_pool_id
                LEFT JOIN category_ip ON primary_sub_pool.sub_pool_id = category_ip.sub_pool_id
                WHERE primary_sub_pool.parent_id =? AND node_detail.customer_id IS NOT NULL AND node_detail.to_date IS NULL";
        $Q = $this->db->query($sql, array($this->getParentid()));
        return $Q->result();
    }

    function get_assigned_catblocks() {
        $sql = "SELECT primary_sub_pool.*,category_ip.subnet as catsubnet FROM primary_sub_pool LEFT JOIN ( nodeip
                LEFT JOIN node_detail ON nodeip.ip_id = node_detail.nodeip_id) ON primary_sub_pool.sub_pool_id = nodeip.sub_pool_id
                LEFT JOIN category_ip ON primary_sub_pool.sub_pool_id = category_ip.sub_pool_id
                WHERE primary_sub_pool.parent_id =? AND category_ip.customer_id IS NOT NULL AND category_ip.to_date IS NULL";
        $Q = $this->db->query($sql,array($this->getParentid()));
        return $Q->result();
    }

    function check_assigned_blocks() {
        $sql = "SELECT * FROM primary_sub_pool LEFT JOIN nodeip ON primary_sub_pool.sub_pool_id = nodeip.sub_pool_id
              LEFT JOIN category_ip ON primary_sub_pool.sub_pool_id = category_ip.sub_pool_id WHERE ((nodeip.category_id IS NOT NULL
              AND nodeip.to_date IS NULL) OR  (category_ip.category_id IS NOT NULL AND category_ip.to_date IS NULL)) AND primary_sub_pool.parent_id =?";
        $Q = $this->db->query($sql,array($this->getParentid()));
        if (($Q->num_rows()) != 0)
            return true; else
            return false;
    }
    
    function get_ippools(){
        $sql="SELECT * FROM ippool";
        $Q=$this->db->query($sql);
        return $Q->result();
    }
    
    function check_assigned_blocks_parentip(){
        $sql="SELECT * FROM primary_sub_pool LEFT JOIN nodeip ON primary_sub_pool.sub_pool_id = nodeip.sub_pool_id
              LEFT JOIN category_ip ON primary_sub_pool.sub_pool_id = category_ip.sub_pool_id WHERE ((nodeip.category_id IS NOT NULL
              AND nodeip.to_date IS NULL) OR  (category_ip.category_id IS NOT NULL AND category_ip.to_date IS NULL)) 
              AND primary_sub_pool.pool_id=? AND primary_sub_pool.parent_id=?
              GROUP BY primary_sub_pool.sub_pool_values ORDER BY inet_aton(sub_pool_values)";
        $Q=$this->db->query($sql,array($this->getPoolid(),$this->getParentid()));
        if (($Q->num_rows()) != 0)
            return true; else
        return false;
    }
    
    function get_assigned_blocks_parentip(){
        $sql="SELECT * FROM primary_sub_pool LEFT JOIN nodeip ON primary_sub_pool.sub_pool_id = nodeip.sub_pool_id
              LEFT JOIN category_ip ON primary_sub_pool.sub_pool_id = category_ip.sub_pool_id WHERE ((nodeip.category_id IS NOT NULL
              AND nodeip.to_date IS NULL) OR  (category_ip.category_id IS NOT NULL AND category_ip.to_date IS NULL)) 
              AND primary_sub_pool.pool_id=?
              GROUP BY primary_sub_pool.sub_pool_values ORDER BY inet_aton(sub_pool_values)";
        $Q=$this->db->query($sql,array($this->getPoolid()));
        return $Q->result();
    }
    
    function get_all_parentip(){
        $sql = "SELECT * FROM primary_sub_pool WHERE subnet=24 AND pool_id=? GROUP BY sub_pool_values ORDER BY inet_aton(sub_pool_values)";
        $Q = $this->db->query($sql, array($this->getPoolid()));
        return $Q->result();
    }
    
    function get_primaryblock(){
        $sql="SELECT * FROM primary_sub_pool WHERE parent_id=?";
        $Q = $this->db->query($sql,array($this->getParentid()));
        return $Q->row_array();
    }
}

?>
