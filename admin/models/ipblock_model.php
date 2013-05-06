<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Nirosan
 * Date: 7/26/12
 * Time: 1:35 PM
 * To change this template use File | Settings | File Templates.
 */
class Ipblock_model extends CI_Model{

    private $category_id;
    private $subcategory_id;
    private $sub_pool_id;
    private $nodeip_id;
    private $subnet;
    private $ip_addresses;
    private $location_id;
    private $ip_id;
    private $parent_id;
    private $customer_id;

    public function getCustomerId() {
        return $this->customer_id;
    }

    public function setCustomerId($customer_id) {
        $this->customer_id = $customer_id;
    }

    public function setCategoryId($category_id)
    {
        $this->category_id = $category_id;
    }

    public function getCategoryId()
    {
        return $this->category_id;
    }

    public function setSubcategoryId($subcategory_id)
    {
        $this->subcategory_id = $subcategory_id;
    }

    public function getSubcategoryId()
    {
        return $this->subcategory_id;
    }

    public function setSubPoolId($sub_pool_id)
    {
        $this->sub_pool_id = $sub_pool_id;
    }

    public function getSubPoolId()
    {
        return $this->sub_pool_id;
    }

    public function setNodeipId($nodeip_id)
    {
        $this->nodeip_id = $nodeip_id;
    }

    public function getNodeipId()
    {
        return $this->nodeip_id;
    }

    public function setIpAddresses($ip_addresses)
    {
        $this->ip_addresses = $ip_addresses;
    }

    public function getIpAddresses()
    {
        return $this->ip_addresses;
    }

    public function setSubnet($subnet)
    {
        $this->subnet = $subnet;
    }

    public function getSubnet()
    {
        return $this->subnet;
    }

    public function getLocationId()
    {
        return $this->location_id;
    }

    public function setLocationId($location_id)
    {
        $this->location_id=$location_id;
    }

    public function setIpId($ip_id)
    {
        $this->ip_id = $ip_id;
    }

    public function getIpId()
    {
        return $this->ip_id;
    }


    public function setParentId($parent_id)
    {
        $this->parent_id = $parent_id;
    }

    public function getParentId()
    {
        return $this->parent_id;
    }

    public function get_category(){
        $sql="SELECT * FROM category";
        $Q=$this->db->query($sql);
        return $Q;
    }

    public function get_subcategory(){
        $sql="SELECT * FROM subcategory WHERE category_id=? ORDER BY location,ssid";
        $Q=$this->db->query($sql,array($this->getCategoryId()));
        return $Q;
    }

    public function get_alllocation(){
        $sql="SELECT * FROM location ORDER BY location";
        $Q=$this->db->query($sql);
        return $Q;
    }

    public function get_location(){
        $sql="SELECT * FROM location WHERE location_id=?";
        $Q=$this->db->query($sql,array($this->getLocationId()));
        if($Q->num_rows()>0){
            foreach ($Q->result_array() as $row){
                $data= $row['location'];
            }
        }
        $Q->free_result();
        return $data;
    }
    public function get_primarysubpool(){
        $sql="SELECT ippool.pool_values,primary_sub_pool.sub_pool_id,primary_sub_pool.sub_pool_values, primary_sub_pool.subnet FROM primary_sub_pool
                INNER JOIN ippool ON primary_sub_pool.pool_id=ippool.pool_id WHERE status=FALSE ORDER BY INET_ATON(primary_sub_pool.sub_pool_values)";
        $Q=$this->db->query($sql);
        return $Q->result();
    }

    public function get_primarysubpool_pag($per_page,$uri_segment){
        $sql="SELECT ippool.pool_values,primary_sub_pool.sub_pool_id,primary_sub_pool.sub_pool_values, primary_sub_pool.subnet FROM primary_sub_pool
                INNER JOIN ippool ON primary_sub_pool.pool_id=ippool.pool_id WHERE status=FALSE ORDER BY INET_ATON(primary_sub_pool.sub_pool_values) LIMIT ".$uri_segment.",".$per_page."";
        $Q=$this->db->query($sql);
        return $Q;
    }

    public function get_primarysubpoolsbyIds(){
        $data=array();
        $ids=$this->getSubPoolId();
        $sql="SELECT sub_pool_values, subnet FROM primary_sub_pool WHERE sub_pool_id IN (".implode(',',$ids).")";
        $Q=$this->db->query($sql);
        if($Q->num_rows()>0){
            foreach ($Q->result_array() as $row){
                $data[] = $row;
            }
        }
        $Q->free_result();
        return $data;
//            return $Q;
    }

    public function get_nodeblocksbyIds(){
        $data=array();
        $ids=$this->getNodeipId();
        $sql="SELECT ip_addresses, subnet FROM nodeip WHERE ip_id IN (".implode(',',$ids).")";
        $Q=$this->db->query($sql);
        if($Q->num_rows()>0){
            foreach ($Q->result_array() as $row){
                $data[] = $row;
            }
        }
        $Q->free_result();
        return $data;
//            return $Q;
    }

    public function add_nodeblocks(){
        $sql1="UPDATE primary_sub_pool SET category_id=1,status=true WHERE sub_pool_id IN (".$this->getSubPoolId().")";
        $sql2="INSERT INTO nodeip SELECT 1,NULL,sub_pool_id,NULL,sub_pool_values,subnet,false,NULL,NULL FROM primary_sub_pool WHERE sub_pool_id IN (".$this->getSubPoolId().")";
        if($Q1=$this->db->query($sql1)){
            if($Q2=$this->db->query($sql2)){
                return $this->db->affected_rows();
            }
        }
    }

    public function add_categoryblocks(){
        $sql1="UPDATE primary_sub_pool SET category_id=?, sub_category_id=?,status=true WHERE sub_pool_id IN (".$this->getSubPoolId().")";
        $sql = array();
        $data=$this->get_subpoolvalues();
        foreach( $data->result() as $row ) {
            $sql[] = '('.$this->getCategoryId().','.$this->getSubcategoryId().','.$row->sub_pool_id.',NULL,"'.$row->sub_pool_values.'",'.$row->subnet.',false,NULL,NULL,NULL,NULL)';

        }

        $sql2="INSERT INTO category_ip VALUES ".implode(',',$sql)."";

        if($this->db->query($sql1,array($this->getCategoryId(),
            $this->getSubcategoryId()))){
            if($this->db->query($sql2)){
                return 1;
            }
        }
    }

    public function get_nodeblocks(){
        $sql="SELECT ip_id,ip_addresses,subnet FROM nodeip WHERE sub_category_id IS NULL and status=FALSE ";
        $Q=$this->db->query($sql);
        return $Q->result();
    }

    public function get_nodeblocks_pag($per_page,$uri_segment){
        $sql="SELECT ip_id,ip_addresses,subnet FROM nodeip WHERE sub_category_id IS NULL and status=FALSE ORDER BY INET_ATON(ip_addresses) LIMIT ".$uri_segment.",".$per_page."";
        $Q=$this->db->query($sql);
        return $Q;
    }

    public function get_ssidlocation(){
        $sql="SELECT ssid,location FROM subcategory WHERE sub_category_id=?";
        $Q=$this->db->query($sql,array($this->getSubcategoryId()));
//            if($Q->num_rows()>0){
//                foreach ($Q->result_array() as $row){
//                    $data[] = $row;
//                }
//            }
//            $Q->free_result();
//            return $data;
        return $Q;
    }

    public function get_categoryname(){
        $sql="SELECT category_name FROM category WHERE category_id=?";
        $Q=$this->db->query($sql,array($this->getCategoryId()));
        if($Q->num_rows()>0){
            foreach ($Q->result_array() as $row){
                $data= $row['category_name'];
            }
        }
        $Q->free_result();
        return $data;
    }

    public function get_ssid(){
        $sql="SELECT ssid FROM subcategory WHERE sub_category_id=?";
        $Q=$this->db->query($sql,array($this->getSubcategoryId()));
        if($Q->num_rows()>0){
            foreach ($Q->result_array() as $row){
                $data= $row['ssid'];
            }
        }
        $Q->free_result();
        return $data;
    }


    public function get_subpoolvalues(){
        $sql="SELECT sub_pool_id,sub_pool_values,subnet FROM primary_sub_pool WHERE sub_pool_id IN (".$this->getSubPoolId().")";
        $Q=$this->db->query($sql);
        return $Q;
    }

    public function insert_category($tablename,$sub_pool_id,$sub_pool_values,$subnet){
        $sql="INSERT INTO $tablename VALUES (".$this->getCategoryId().",".$this->getSubcategoryId().",$sub_pool_id,NULL,$sub_pool_values,$subnet,1,NULL,NULL,NULL)";
        $this->db->query($sql);
    }

    public function add_nodedetails(){
        $sql="INSERT INTO node_detail VALUES(?,?,?,?,?,?,?,?,?)";
        $this->db->query($sql,array(NULL,$this->getNodeipId(),$this->getSubnet(),$this->getIpAddresses(),NULL, NULL,NULL,NULL,NULL));
//            return $this->db->affected_rows();
        return $sql;
    }

    public function update_nodeip(){
        $ids=$this->getNodeipId();
        $sql="UPDATE nodeip SET sub_category_id=?,status=true,from_date=curdate() WHERE ip_id IN(".implode(',',$ids).")";
        $this->db->query($sql,array($this->getSubcategoryId()));
        return $this->db->affected_rows();
    }

    public function get_allnodeip(){
        $sql="SELECT nodeip.*,subcategory.location,subcategory.ssid FROM nodeip LEFT JOIN subcategory ON nodeip.sub_category_id=subcategory.sub_category_id WHERE to_date IS NULL ORDER BY INET_ATON(nodeip.ip_addresses)";
        $Q=$this->db->query($sql);
        return $Q->result();
    }

    public function get_allnodeip_pag($per_page,$uri_segment){
        $sql="SELECT nodeip.*,subcategory.location,subcategory.ssid FROM nodeip LEFT JOIN subcategory ON nodeip.sub_category_id=subcategory.sub_category_id WHERE to_date IS NULL ORDER BY INET_ATON(nodeip.ip_addresses) LIMIT ".$uri_segment.",".$per_page."";
        $Q=$this->db->query($sql);
        return $Q;
    }

    public function get_nodeipbyid(){
        $sql="SELECT * FROM nodeip WHERE ip_id=?";
        $Q=$this->db->query($sql,array($this->getNodeipId()));
        return $Q;
    }

    public function get_locationip(){
        $sql="SELECT * FROM nodeip LEFT JOIN subcategory ON nodeip.sub_category_id = subcategory.sub_category_id WHERE subcategory.location_id =? AND to_date IS NULL";
        $Q=$this->db->query($sql,array($this->getLocationId()));
        return $Q->result();
    }

    public function check_nodedetail($nodeip_id){
        $sql="SELECT * FROM node_detail WHERE nodeip_id=$nodeip_id AND customer_id IS NOT NULL AND to_date IS NULL";
        $Q=$this->db->query($sql);
        if($Q->num_rows()==0){
            return 0;
        }else return 1;

    }

    public function get_locationip_pag($per_page,$uri_segment){
        $sql="SELECT nodeip.*,subcategory.location,subcategory.ssid FROM nodeip LEFT JOIN subcategory ON nodeip.sub_category_id = subcategory.sub_category_id WHERE subcategory.location_id =? AND to_date IS NULL ORDER BY INET_ATON(nodeip.ip_addresses) LIMIT ".$uri_segment.",".$per_page."";
        $Q=$this->db->query($sql,array($this->getLocationId()));
        return $Q;
    }
    public function get_locationip_new(){
        $sql="SELECT nodeip.*,subcategory.location,subcategory.ssid FROM nodeip LEFT JOIN subcategory ON nodeip.sub_category_id = subcategory.sub_category_id WHERE subcategory.location_id =? AND to_date IS NULL ORDER BY INET_ATON(nodeip.ip_addresses) ";
        $Q=$this->db->query($sql,array($this->getLocationId()));
        return $Q;
    }

    public function get_subcategoryip(){
        if($this->getSubcategoryId()!=0){
            $sql="SELECT category_ip.ip_id, category_ip.ip_addresses, category_ip.subnet, category_ip.status,category.category_name,subcategory.ssid FROM category_ip INNER JOIN category ON category_ip.category_id=category.category_id INNER JOIN subcategory ON category_ip.sub_category_id=subcategory.sub_category_id  WHERE category_ip.category_id =? AND category_ip.sub_category_id=? AND category_ip.to_date IS NULL";
        }
        else{
            $sql="SELECT category_ip.ip_id, category_ip.ip_addresses, category_ip.subnet, category_ip.status,category.category_name,subcategory.ssid FROM category_ip INNER JOIN category ON category_ip.category_id=category.category_id INNER JOIN subcategory ON category_ip.sub_category_id=subcategory.sub_category_id  WHERE category_ip.category_id =? AND category_ip.sub_category_id IS NOT NULL AND category_ip.to_date IS NULL";
        }
        $Q=$this->db->query($sql,array($this->getCategoryId(),$this->getSubcategoryId()));
        return $Q->result();
    }

    public function get_subcategoryip_pag($per_page,$uri_segment){
        if($this->getSubcategoryId()!=0){
            $sql="SELECT category_ip.*,category.category_name,subcategory.ssid FROM category_ip INNER JOIN category ON category_ip.category_id=category.category_id INNER JOIN subcategory ON category_ip.sub_category_id=subcategory.sub_category_id  WHERE category_ip.category_id =? AND category_ip.sub_category_id=? AND category_ip.to_date IS NULL ORDER BY INET_ATON(category_ip.ip_addresses) LIMIT ".$uri_segment.",".$per_page."";
        }
        else{
            $sql="SELECT category_ip.*,category.category_name,subcategory.ssid FROM category_ip INNER JOIN category ON category_ip.category_id=category.category_id INNER JOIN subcategory ON category_ip.sub_category_id=subcategory.sub_category_id  WHERE category_ip.category_id =? AND category_ip.sub_category_id IS NOT NULL AND category_ip.to_date IS NULL ORDER BY INET_ATON(category_ip.ip_addresses) LIMIT ".$uri_segment.",".$per_page."";
        }
        $Q=$this->db->query($sql,array($this->getCategoryId(),$this->getSubcategoryId()));
        return $Q;
    }
    public function get_subcategoryip_new(){
        if($this->getSubcategoryId()!=0){
            $sql="SELECT category_ip.*,category.category_name,subcategory.ssid FROM category_ip INNER JOIN category ON category_ip.category_id=category.category_id INNER JOIN subcategory ON category_ip.sub_category_id=subcategory.sub_category_id  WHERE category_ip.category_id =? AND category_ip.sub_category_id=? AND category_ip.to_date IS NULL ORDER BY INET_ATON(category_ip.ip_addresses)";
        }
        else{
            $sql="SELECT category_ip.*,category.category_name,subcategory.ssid FROM category_ip INNER JOIN category ON category_ip.category_id=category.category_id INNER JOIN subcategory ON category_ip.sub_category_id=subcategory.sub_category_id  WHERE category_ip.category_id =? AND category_ip.sub_category_id IS NOT NULL AND category_ip.to_date IS NULL ORDER BY INET_ATON(category_ip.ip_addresses)";
        }
        $Q=$this->db->query($sql,array($this->getCategoryId(),$this->getSubcategoryId()));
        return $Q;
    }

    public function get_nodedetails(){
//        $sql="SELECT node_detail.*,customers.customer_name,node_type.type_name FROM node_detail LEFT JOIN customers ON node_detail.customer_id=customers.customer_id
//            LEFT JOIN node_type ON node_detail.type_id=node_type.type_id WHERE nodeip_id=? AND to_date IS NULL";
        $sql="SELECT node_detail . * , tbl_customer.name, node_type.type_name
FROM node_detail
LEFT JOIN (
tbl_customer
LEFT JOIN tbl_custservmaster ON tbl_customer.id = tbl_custservmaster.cust_id
) ON node_detail.customer_id = tbl_custservmaster.id
LEFT JOIN node_type ON node_detail.type_id = node_type.type_id
WHERE nodeip_id =?
AND to_date IS NULL";
        $Q=$this->db->query($sql,array($this->getNodeipId()));
        return $Q->result();
    }

    public function get_nodedetails_pag($per_page,$uri_segment){
        $sql="SELECT node_detail.*,customers.customer_name,node_type.type_name FROM node_detail LEFT JOIN customers ON node_detail.customer_id=customers.customer_id
            LEFT JOIN node_type ON node_detail.type_id=node_type.type_id WHERE nodeip_id=? AND to_date IS NULL LIMIT ".$uri_segment.",".$per_page."";
        $Q=$this->db->query($sql,array($this->getNodeipId()));
        return $Q;
    }

    public function get_customerbyip(){
        $sql="SELECT category_ip.ip_id, category_ip.from_date, tbl_customer.name, tbl_custservmaster.id
FROM category_ip LEFT JOIN (tbl_customer LEFT JOIN tbl_custservmaster
            ON tbl_customer.id=tbl_custservmaster.cust_id)
            ON category_ip.customer_id=tbl_custservmaster.id 
WHERE category_ip.ip_id =?
AND category_ip.to_date IS NULL";
        $Q=$this->db->query($sql,array($this->getIpId()));
        return $Q;
    }
    
//    public function get_customerbyip(){
//        $sql="SELECT category_ip.ip_id,category_ip.from_date,customers.customer_name,customers.customer_id FROM category_ip LEFT JOIN customers ON category_ip.customer_id=customers.customer_id WHERE category_ip.ip_id=? AND category_ip.to_date IS NULL";
//        $Q=$this->db->query($sql,array($this->getIpId()));
//        return $Q;
//    }

//        public function check_Allsubnettednodeip(){
//            $sql="SELECT * FROM nodeip WHERE sub_pool_id=? AND sub_category_id IS NOT NULL";
//            $Q=$this->db->query($sql,array($this->getSubPoolId()));
//            if($Q->num_rows()==0){
//                return true;
//            }
//        }

    public function delete_nodeblocks(){
        if($this->getSubcategoryId()!=null){
            if(!($this->check_nodedetail($this->getNodeipId()))){
                $sql1="UPDATE nodeip SET to_date=curdate() WHERE ip_id=?";
                $sql2="INSERT INTO nodeip SELECT category_id,null,sub_pool_id,null,ip_addresses,subnet,false,null,null FROM nodeip WHERE ip_id=?";
                $sql3="DELETE FROM node_detail WHERE nodeip_id=?";
                $Q1=$this->db->query($sql1,array($this->getNodeipId()));
                $Q2=$this->db->query($sql2,array($this->getNodeipId()));
                $Q3=$this->db->query($sql3,array($this->getNodeipId()));
                return TRUE;
            }
        }
        else if($this->getSubcategoryId()==null){
//            $sql1="INSERT INTO primary_sub_pool SELECT primary_sub_pool.pool_id,null,nodeip.ip_addresses,nodeip.subnet,null,null,false,nodeip.sub_pool_id FROM primary_sub_pool,nodeip WHERE primary_sub_pool.sub_pool_id=nodeip.sub_pool_id AND nodeip.ip_id=?";
            $sql1="INSERT INTO primary_sub_pool SELECT primary_sub_pool.pool_id,null,nodeip.ip_addresses,nodeip.subnet,null,null,false,primary_sub_pool.parent_id FROM primary_sub_pool,nodeip WHERE primary_sub_pool.sub_pool_id=nodeip.sub_pool_id AND nodeip.ip_id=?";
            $sql2="DELETE FROM nodeip WHERE ip_id=?";
            if($this->db->query($sql1,array($this->getNodeipId())) && $this->db->query($sql2,array($this->getNodeipId())))
                return TRUE;
        }else return FALSE;
    }

    public function delete_categoryblocks(){
        if($this->getCustomerId()!=null){
            return FALSE;
        }else if ($this->getCustomerId()==null){
//            $sql1="INSERT INTO primary_sub_pool SELECT p.pool_id,null,c.ip_addresses,c.subnet,null,null,false,c.sub_pool_id FROM primary_sub_pool p,category_ip c WHERE p.sub_pool_id=c.sub_pool_id AND c.ip_id=?";
            $sql1="INSERT INTO primary_sub_pool SELECT p.pool_id,null,c.ip_addresses,c.subnet,null,null,false,p.parent_id FROM primary_sub_pool p,category_ip c WHERE p.sub_pool_id=c.sub_pool_id AND c.ip_id=?";
            $sql2="DELETE FROM category_ip WHERE ip_id=? AND status=false AND from_date IS NULL AND to_date IS NULL";
//               $Q1=$this->db->query($sql1,array($this->getIpId()));
//               $Q2=$this->db->query($sql2,array($this->getIpId()));
            if ($this->db->query($sql1,array($this->getIpId()))) {
                if($this->db->query($sql2,array($this->getIpId()))){
                    return TRUE;
                }
            }
        }
    }

    public function getSomething(){

        $sql="SELECT ip_id,ip_addresses,subnet,status FROM nodeip";
        $this->load->library('DatatablesHelper');

        return $this->datatableshelper->query($sql);


    }

//    ********* //
    
    public function get_catblocksbyIds(){
        $data=array();
        $ids=$this->getSubPoolId();
        $sql="SELECT ip_addresses, subnet FROM category_ip WHERE ip_id IN (".implode(',',$ids).")";
        $Q=$this->db->query($sql);
        if($Q->num_rows()>0){
            foreach ($Q->result_array() as $row){
                $data[] = $row;
            }
        }
        $Q->free_result();
        return $data;
//            return $Q;
    }
}
?>