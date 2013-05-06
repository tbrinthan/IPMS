<?php
/*  DATE        NAME        DESCRIPTION
 *  25-Jul-12   Brinthan    Initialize the Model
 *
 * */
class IP_Model extends CI_Model{
    public function __construct(){
        parent::__construct();
    }
    private $POOL_VALUES, $POOL_ID, $SUBNET, $SUBPOOL_VALUE, $SUBPOOL_SUBNET;

    public function setPoolValue($x){$this->POOL_VALUES = $x;}
    public function setPoolID($x){$this->POOL_ID = $x;}
    public function setSubnetMask($x){$this->SUBNET = $x;}
    public function setSubPoolValue($x){$this->SUBPOOL_VALUE = $x;}
    public function setSubPoolSubnet($x){$this->SUBPOOL_SUBNET = $x;}

    public function getPoolValue(){return $this->POOL_VALUES;}
    public function getPoolID(){return $this->POOL_ID;}
    public function getSubnetMask(){return $this->SUBNET;}
    public function getSubPoolValue(){return $this->SUBPOOL_VALUE;}
    public function getSubPoolSubnet(){return $this->SUBPOOL_SUBNET;}


    public function getIPPool(){
        $sql    = "SELECT * FROM ippool";
        $result = $this->db->query($sql);
        return $result->result();
    }

    public function getLastFromIPPool(){
        $sql    = "SELECT * FROM ippool ORDER BY pool_id DESC LIMIT 1";
        $result = $this->db->query($sql);
        return $result->result();
    }

    public function getPoolValueByID(){
        $sql ="SELECT pool_values FROM ippool WHERE pool_id = ?";
        $result = $this->db->query($sql,array($this->getPoolID()));
        return $result->row_array();
    }

    public function saveIPPool(){
        $sql = "INSERT INTO ippool(pool_values, subnet) VALUES(?,?)";
        $this->db->query($sql,array($this->getPoolValue(),$this->getSubnetMask()));
        return $this->db->affected_rows();
    }

    function validateIPPool(){
        $sql="SELECT * FROM ippool WHERE pool_values=?";
        $result = $this->db->query($sql,array($this->getPoolValue()));
        if($result->num_rows() != 1) return 1 ; //checking if any previous row with same value  exist
        else return 0;
    }

    function addSubIPPool(){
        $sql="INSERT INTO primary_sub_pool(pool_id,sub_pool_values,subnet,category_id,sub_category_id,status) VALUES(?,?,?,?,?,?)";
        $this->db->query($sql,array($this->getPoolID(),$this->getSubPoolValue(),$this->getSubPoolSubnet(), null, null, '0'));
        $sql1 = "UPDATE primary_sub_pool SET primary_sub_pool.parent_id = sub_pool_id WHERE primary_sub_pool.pool_id = ? ";
        $this->db->query($sql1,array($this->getPoolID()));
        return $this->db->affected_rows();
    }

    function checkSubPoolByUsingPoolID(){
        $sql="SELECT * FROM primary_sub_pool WHERE pool_id = ? AND (category_id IS NOT NULL  OR status=1)";
        $result = $this->db->query($sql,array($this->getPoolID()));
      if($result->num_rows() == 0) return 1;
        else return 0;
    }

    function deletePrimarySubIPPool(){
        $sql = "DELETE FROM primary_sub_pool WHERE pool_id = ?";
        $this->db->query($sql,array($this->getPoolID()));
        return $this->db->affected_rows();
    }

    function deleteMainIPPool(){
        if($this->deletePrimarySubIPPool()){
        $sql= "DELETE FROM ippool WHERE pool_id = ?";
        $this->db->query($sql,array($this->getPoolID()));
        $this->db->affected_rows();
            return 1;
        }
        else return 0 ;
    }

    public function getMainSubPrimaryPool(){
        $sql = "SELECT primary_sub_pool.pool_id,primary_sub_pool.sub_pool_id,primary_sub_pool.sub_pool_values,primary_sub_pool.status,primary_sub_pool.subnet,subcategory.ssid,category.category_name,ippool.pool_values FROM primary_sub_pool INNER JOIN ippool ON primary_sub_pool.pool_id = ippool.pool_id LEFT JOIN category ON primary_sub_pool.category_id = category.category_id LEFT JOIN subcategory ON primary_sub_pool.sub_category_id = subcategory.sub_category_id WHERE primary_sub_pool.pool_id = ?";
        $results = $this->db->query($sql,array($this->getPoolID()));
        return $results ->result();
    }

    public function getMainSubPrimaryPools($per_page,$uri_segment){
        $sql = "SELECT primary_sub_pool.pool_id,primary_sub_pool.sub_pool_id,primary_sub_pool.sub_pool_values,primary_sub_pool.status,primary_sub_pool.subnet,subcategory.ssid,category.category_name,ippool.pool_values FROM primary_sub_pool INNER JOIN ippool ON primary_sub_pool.pool_id = ippool.pool_id LEFT JOIN category ON primary_sub_pool.category_id = category.category_id LEFT JOIN subcategory ON primary_sub_pool.sub_category_id = subcategory.sub_category_id WHERE primary_sub_pool.pool_id = ? LIMIT ".$uri_segment.",".$per_page."";
        $results = $this->db->query($sql,array($this->getPoolID()));
        return $results->result();
    }
}