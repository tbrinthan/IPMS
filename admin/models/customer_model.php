<?php

/**
 *DATE          USER        DETAILS
 * 08-Aug-12    Brinthan    Initialization
 */

class Customer_Model extends CI_Model{
    function Customer_Model(){
        parent::__construct();
    }
    private $CUSTOMER_ID,$CUSTSERV_ID, $LINKS,$CUSTOMER_NAME,$CONNECTION_NAME,$BANDWIDTH,$ADDRESS,$SUBCAT_ID,$NODE_DETAIL_ID,$LOCATION_ID,$NODE_TYPE_ID,$CATEGORY_ID,$CATEGORY_IP_ID,$PVT_IP,$PVT_CIDR,$PVT_IP_ID,$END_DATE,$REMARK;
    public function getCustomerID(){return $this->CUSTOMER_ID;}
    public function getLinks(){return $this->LINKS;}
    public function getCustservID(){return $this->CUSTSERV_ID;}
    public function getSubCatID(){return $this->SUBCAT_ID;}
    public function getCustomerName(){return $this->CUSTOMER_NAME;}
    public function getConnectionName(){return $this->CONNECTION_NAME;}
    public function getBW(){return $this->BANDWIDTH;}
    public function getAddress(){return $this->ADDRESS;}
    public function getNodeDetailID(){return $this->NODE_DETAIL_ID;}
    public function getLocationID(){return $this->LOCATION_ID;}
    public function getNodeTypeID(){return $this->NODE_TYPE_ID;}
    public function getCategoryID(){return $this->CATEGORY_ID;}
    public function getCategoryIPID(){return $this->CATEGORY_IP_ID;}
    public function getPvtCIDR(){return $this->PVT_CIDR;}
    public function getPvtIP(){return $this->PVT_IP;}
    public function getPvtIPID(){return $this->PVT_IP_ID;}
    public function getEndDate(){return $this->END_DATE;}
    public function getRemark(){return $this->REMARK;}


    public function setCustomerID($x){$this->CUSTOMER_ID = $x;}
    public function setLinks($x){$this->LINKS = $x;}
    public function setCustservID($x){$this->CUSTSERV_ID = $x;}
    public function setSubCatID($x){$this->SUBCAT_ID = $x;}
    public function setCustomerName($x){$this->CUSTOMER_NAME = $x;}
    public function setConnectionName($x){$this->CONNECTION_NAME = $x;}
    public function setBW($x){$this->BANDWIDTH = $x;}
    public function setAddress($x){$this->ADDRESS = $x;}
    public function setNodeDetailID($x){$this->NODE_DETAIL_ID = $x;}
    public function setLocationID($x){$this->LOCATION_ID = $x;}
    public function setNodeTypeID($x){$this->NODE_TYPE_ID = $x;}
    public function setCategoryID($x){$this->CATEGORY_ID = $x;}
    public function setCategoryIPID($x){$this->CATEGORY_IP_ID = $x;}
    public function setPvtCIDR($x){$this->PVT_CIDR = $x;}
    public function setPvtIP($x){$this->PVT_IP = $x;}
    public function setPvtIPID($x){$this->PVT_IP_ID = $x;}
    public function setEndDate($x){$this->END_DATE = $x;}
    public function setRemark($x){$this->REMARK = $x;}


//Get all Customer Details
    function getCustomerDetails(){
        $sql = "SELECT * FROM customers ORDER BY customer_name";
        $result = $this->db->query($sql);
        return $result->result();
    }
   
//Get Customer Details by Customer ID
    function getCustomerDetailsByID(){
        $sql = "SELECT * FROM customers WHERE customer_id = ?";
        $result = $this->db->query($sql,array($this->getCustomerID()));
        return $result->result();
    }
    
    
/*******************Functions Written for customer related tables in CRM****************/
   function getCustomerDetails_crm(){
        $sql = "SELECT DISTINCT tbl_customer.id, tbl_customer.name
FROM tbl_custservmaster
LEFT JOIN tbl_customer ON tbl_customer.id = tbl_custservmaster.cust_id
WHERE tbl_customer.id IS NOT NULL AND tbl_custservmaster.servicecode IN ('LN','IH','M','ND')
GROUP BY tbl_customer.id ORDER BY tbl_customer.name";
        $result = $this->db->query($sql);
        return $result->result();
} 
//    function getCustomerWithLinksbyID(){
//        $sql = "SELECT DISTINCT tbl_cuslinks.servicecode, tbl_cuslinks.connstatus, tbl_cuslinks.cname, tbl_cuslinks.serialno, tbl_cuslinks.linkname, tbl_cuslinks.link, tbl_service.name,tbl_custservmaster.location,tbl_custservmaster.ltown FROM tbl_cuslinks, tbl_service, tbl_custservmaster 
//	WHERE tbl_cuslinks.cuscode=? 
//	AND tbl_cuslinks.connstatus<>9 
//	AND tbl_cuslinks.servicecode = tbl_service.servicecode
//	AND tbl_cuslinks.servicecode = tbl_custservmaster.servicecode
//	AND tbl_cuslinks.cuscode = tbl_custservmaster.cust_id
//	AND tbl_cuslinks.serialno = tbl_custservmaster.serialno";
//        $result = $this->db->query($sql,array($this->getCustomerID()));
//        return $result->result();
//    }
//    
//    function getCustomerWithoutLinksbyID(){
//        $sql = "SELECT tbl_customer.name, tbl_customer.id as cust_id, tbl_custservmaster.servicecode, tbl_custservmaster.ltown, tbl_custservmaster.connstatus, tbl_custservmaster.identify, tbl_custservmaster.status AS stat, tbl_custservmaster.id as custserv_id, tbl_custservmaster.serialno AS serial, tbl_service.name AS service_name
//        FROM tbl_customer, tbl_custservmaster, tbl_service WHERE tbl_customer.id =?
//        AND tbl_custservmaster.connstatus <>9 AND tbl_customer.id = tbl_custservmaster.cust_id
//        AND tbl_custservmaster.servicecode <> 'LN' AND tbl_custservmaster.servicecode = tbl_service.servicecode
//        AND tbl_service.withlink = '0'";
//        $result = $this->db->query($sql,array($this->getCustomerID()));
//        return $result;
//    }
    
    function getCustomerServicebyID(){
        $sql = "SELECT tbl_custservmaster.id, tbl_customer.id AS cust_id, tbl_customer.name, tbl_custservmaster.servicecode, tbl_custservmaster.ltown, tbl_custservmaster.connstatus, tbl_custservmaster.identify, tbl_custservmaster.status AS stat, tbl_custservmaster.id, tbl_custservmaster.serialno AS serial, tbl_service.name AS service_name
        FROM tbl_customer, tbl_custservmaster, tbl_service WHERE tbl_customer.id =?
        AND tbl_custservmaster.connstatus <>9 AND tbl_customer.id = tbl_custservmaster.cust_id
        AND tbl_custservmaster.servicecode <> 'LN' AND tbl_custservmaster.servicecode IN ('IH','M') AND tbl_custservmaster.servicecode = tbl_service.servicecode
        AND tbl_service.withlink = '0'";
        $result = $this->db->query($sql,array($this->getCustomerID()));
        return $result->result();
    }
    
    
    function getCustomerLinksbyID(){
        $sql = "SELECT DISTINCT tbl_custservmaster.id, tbl_cuslinks.servicecode, tbl_cuslinks.connstatus, tbl_cuslinks.serialno, tbl_cuslinks.linkname, tbl_cuslinks.link, tbl_service.name
FROM tbl_cuslinks
LEFT JOIN tbl_service ON tbl_cuslinks.servicecode = tbl_service.servicecode
LEFT JOIN tbl_custservmaster ON tbl_custservmaster.cust_id = tbl_cuslinks.cuscode
AND tbl_custservmaster.serialno = tbl_cuslinks.serialno
AND tbl_custservmaster.servicecode = tbl_cuslinks.servicecode
WHERE tbl_cuslinks.cuscode =?
AND tbl_cuslinks.connstatus <>9
AND tbl_custservmaster.servicecode = 'LN'";
        $result = $this->db->query($sql,array($this->getCustomerID()));
        return $result->result();
    }
    

    
    function getMainLinkbyID(){
        $links=$this->getLinks();
        $sql="SELECT DISTINCT tbl_custservmaster.id,tbl_custservmaster.link,
            tbl_custservmaster.connstatus,tbl_service.name
FROM tbl_custservmaster
LEFT JOIN tbl_cuslinks ON tbl_custservmaster.cust_id = tbl_cuslinks.cuscode
AND tbl_custservmaster.link = tbl_cuslinks.link
LEFT JOIN tbl_service ON tbl_custservmaster.servicecode = tbl_service.servicecode
WHERE tbl_custservmaster.cust_id =?
AND tbl_custservmaster.connstatus <>9
AND tbl_custservmaster.servicecode <> 'LN'
AND tbl_custservmaster.link
IN (".implode(',',$links).")";
         $result=$this->db->query($sql,array($this->getCustomerID()));
        return $result->result();
    }
    
        function getLinksDetailbyID(){
        $sql="SELECT  tbl_custservmaster.id,tbl_custservmaster.link,tbl_custservmaster.serialno,
            tbl_custservmaster.identify,tbl_custservmaster.ltown,
        tbl_custservmaster.connstatus,tbl_custservmaster.location,tbl_customer.name, tbl_customer.id AS cust_id,
        tbl_service.name AS service_name, tbl_service.servicecode 
        FROM  tbl_custservmaster, tbl_customer,tbl_service 
        WHERE tbl_custservmaster.id = ?
        AND  tbl_custservmaster.cust_id = tbl_customer.id
        AND tbl_custservmaster.servicecode = tbl_service.servicecode ";
        $result=$this->db->query($sql,array($this->getCustservID()));
        return $result->result();
    }
    
    function getInternetTypes($id){
       $sql="
SELECT DISTINCT tbl_custservmaster.id AS custserv_id, tbl_internet_types.ptype, tbl_internet_types.longname AS internet_type, tbl_internet_speeds.speedtype, tbl_internet_speeds.speedname AS speed
FROM tbl_custservmaster
LEFT JOIN tbl_internet_types ON tbl_internet_types.ptype = tbl_custservmaster.ptype
LEFT JOIN tbl_internet_speeds ON tbl_internet_speeds.speedtype = tbl_custservmaster.linkspeed
WHERE tbl_custservmaster.id =".$id."";
       $result=$this->db->query($sql);
      return $result->row_array();
    }
    
    function getServiceDetailbyID(){
        $sql="SELECT tbl_custservmaster.id, tbl_customer.id AS cust_id, tbl_customer.name, tbl_custservmaster.servicecode, tbl_custservmaster.ltown, tbl_custservmaster.connstatus, tbl_custservmaster.identify, tbl_custservmaster.status AS stat, tbl_custservmaster.id, tbl_custservmaster.serialno AS serial, tbl_service.name AS service_name
FROM tbl_customer, tbl_custservmaster, tbl_service
WHERE tbl_custservmaster.id =?
AND tbl_custservmaster.connstatus <>9
AND tbl_customer.id = tbl_custservmaster.cust_id
AND tbl_custservmaster.servicecode <> 'LN'
AND tbl_custservmaster.servicecode = tbl_service.servicecode
AND tbl_service.withlink = '0'";
        $result=$this->db->query($sql,$this->getCustservID());
        return $result->result();
        
    }

    /************************************End of CRM functions**********************************/    

//Get NodeIP Details
    function getNodeIPDetails(){
        $sql= "SELECT * FROM node_detail LEFT JOIN nodeip ON node_detail.nodeip_id = nodeip.ip_id LEFT JOIN subcategory ON nodeip.sub_category_id=subcategory.sub_category_id";
        $result = $this->db->query($sql);
        return $result->result();

    }

//Get Node IP details by SubCategory ID  to display for assigning to customers
    function getNodeIPDetailsBySubCatID(){
//        $sql= "SELECT node_detail.*,nodeip.sub_category_id,node_type.*,customers.* FROM node_detail LEFT JOIN nodeip ON node_detail.nodeip_id = nodeip.ip_id LEFT JOIN node_type ON node_detail.type_id= node_type.type_id LEFT JOIN customers ON node_detail.customer_id=customers.customer_id WHERE nodeip.sub_category_id = ? AND ((node_detail.from_date IS NULL AND node_detail.to_date IS NULL )OR (node_detail.from_date IS NOT NULL AND node_detail.to_date IS NULL)) ORDER BY INET_ATON( node_detail.ip_addresses )";
        $sql= "SELECT node_detail.*,nodeip.sub_category_id,node_type.*,tbl_customer.name 
            FROM node_detail LEFT JOIN nodeip ON node_detail.nodeip_id = nodeip.ip_id 
            LEFT JOIN node_type ON node_detail.type_id= node_type.type_id 
            LEFT JOIN (tbl_customer LEFT JOIN tbl_custservmaster
            ON tbl_customer.id=tbl_custservmaster.cust_id)
            ON node_detail.customer_id=tbl_custservmaster.id 
            WHERE nodeip.sub_category_id = ? AND ((node_detail.from_date IS NULL 
            AND node_detail.to_date IS NULL )OR (node_detail.from_date IS NOT NULL 
            AND node_detail.to_date IS NULL)) 
            ORDER BY INET_ATON( node_detail.ip_addresses )";
        $result = $this->db->query($sql,array($this->getSubCatID()));
        if($result->num_rows() == 0) return 0;
        else return $result->result();

    }

//Get Node IP details by SubCategory ID  to display for assigning to customers :- For Pagination
    function getNodeIPDetailsBySubCatIDPage($per_page,$uri_segment){
        $sql= "SELECT node_detail.*,nodeip.sub_category_id,node_type.*,customers.* FROM node_detail LEFT JOIN nodeip ON node_detail.nodeip_id = nodeip.ip_id LEFT JOIN node_type ON node_detail.type_id= node_type.type_id LEFT JOIN customers ON node_detail.customer_id=customers.customer_id WHERE nodeip.sub_category_id = ? AND ((node_detail.from_date IS NULL AND node_detail.to_date IS NULL )OR (node_detail.from_date IS NOT NULL AND node_detail.to_date IS NULL)) ORDER BY INET_ATON( node_detail.ip_addresses ) LIMIT ".$uri_segment.",".$per_page."";
        $result = $this->db->query($sql,array($this->getSubCatID()));
        if($result->num_rows() == 0) return 0;
        else return $result->result();
    }

// Get Node SSID Details
    function getNodeSubCategory(){
        $sql="SELECT subcategory.sub_category_id,subcategory.ssid,subcategory.location,subcategory.location_id FROM subcategory WHERE category_id = 1";
        $result = $this->db->query($sql);
        return $result->result();
    }

//Get Subcategory Name by Sub CategoryID
    function getSubCategoryNameByID(){
        $sql= "SELECT subcategory.ssid,subcategory.location FROM subcategory WHERE sub_category_id =?";
        $result = $this->db->query($sql,array($this->getSubCatID()));
        return $result->row_array();
    }

//Save Node Details for the Customers By Customer ID
    function saveNodeDetailsByCustID(){
        $i = 0 ;
        $bool = true;
        $ids=$this->getNodeDetailID();
        $select_ids = $this->getNodeTypeID();
        $cust = $this->getCustomerID();
        $custserv = $this->getCustservID();

        if(sizeof($select_ids)==0) $bool=false;
        for($i = 0;$i<sizeof($select_ids);$i++){
            if($select_ids[$i] == 0 || $custserv == 0 || sizeof($ids)== 0) $bool = false;
        }
        if($bool){
            for($i = 0;$i<sizeof($ids);$i++){
//            $sql = "UPDATE node_detail SET type_id=".$select_ids[$i].",customer_id=".$cust.",from_date= CURDATE() WHERE node_detail_id=".$ids[$i]."";
            $sql = "UPDATE node_detail SET type_id=".$select_ids[$i].",customer_id=".$custserv.",from_date= CURDATE() WHERE node_detail_id=".$ids[$i]."";
            $this->db->query($sql);
            }
            return $this->db->affected_rows();
        }
        else return 0;

    }

//Get all Locations
    function getLocations(){
        $sql = "SELECT * FROM location ORDER BY location";
        $result = $this->db->query($sql);
        return $result->result();
    }

//Get SSID per Locations by Location ID
    function getSSIDByLocationID(){
        $sql = "SELECT subcategory.ssid,subcategory.sub_category_id,subcategory.location_id FROM subcategory WHERE subcategory.location_id = ? ORDER BY subcategory.ssid";
        $result = $this->db->query($sql,array($this->getLocationID()));
        return $result->result();
    }

//Get NodeTypes details
    function getNodeTypes(){
        $sql ="SELECT * FROM node_type";
        $result =$this->db->query($sql);
        return $result->result();
    }

//Get Node Details BY Customer ID
    function getNodeDetailsByCustomerID(){
        $sql ="SELECT category.*,subcategory.*,node_detail.*,node_type.*,customers.customer_id,customers.customer_name,customers.address,customers.connection_name,customers.bandwidth,nodeip.sub_category_id,nodeip.category_id FROM node_detail LEFT JOIN nodeip ON nodeip.ip_id = node_detail.nodeip_id LEFT JOIN customers ON customers.customer_id = node_detail.customer_id LEFT JOIN node_type ON node_type.Type_id = node_detail.type_id LEFT JOIN subcategory ON subcategory.sub_category_id = nodeip.sub_category_id LEFT JOIN category ON subcategory.category_id = category.category_id WHERE customers.customer_id=? AND ((node_detail.from_date IS NULL AND node_detail.to_date IS NULL )OR (node_detail.from_date IS NOT NULL AND node_detail.to_date IS NULL))";
        $result = $this->db->query($sql,array($this->getCustomerID()));
        return $result->result();
    }
// Editted due to use crm customers    
    function getNodeDetailsByCustomerIDD(){
        $sql ="SELECT category. * , subcategory. * , node_detail. * , node_type. * ,
            nodeip.sub_category_id, nodeip.category_id, tbl_custservmaster.link, 
            tbl_custservmaster.identify,tbl_custservmaster.ltown,
            tbl_service.name AS service_name FROM node_detail 
            LEFT JOIN nodeip ON nodeip.ip_id = node_detail.nodeip_id
            LEFT JOIN ( tbl_custservmaster LEFT JOIN tbl_service ON tbl_custservmaster.servicecode = tbl_service.servicecode )
            ON tbl_custservmaster.id = node_detail.customer_id
            LEFT JOIN node_type ON node_type.Type_id = node_detail.type_id
            LEFT JOIN subcategory ON subcategory.sub_category_id = nodeip.sub_category_id
            LEFT JOIN category ON subcategory.category_id = category.category_id
            WHERE tbl_custservmaster.cust_id =?
            AND (( node_detail.from_date IS NULL AND node_detail.to_date IS NULL)
            OR ( node_detail.from_date IS NOT NULL AND node_detail.to_date IS NULL))";
        $result = $this->db->query($sql,array($this->getCustomerID()));
        return $result->result();
    }
    
    function getNodeDetailsByCustservID(){
        $sql ="SELECT category.*,subcategory.*,node_detail.*,node_type.*,nodeip.sub_category_id,nodeip.category_id FROM node_detail LEFT JOIN nodeip ON nodeip.ip_id = node_detail.nodeip_id  LEFT JOIN node_type ON node_type.Type_id = node_detail.type_id LEFT JOIN subcategory ON subcategory.sub_category_id = nodeip.sub_category_id LEFT JOIN category ON subcategory.category_id = category.category_id WHERE node_detail.customer_id=? AND ((node_detail.from_date IS NULL AND node_detail.to_date IS NULL )OR (node_detail.from_date IS NOT NULL AND node_detail.to_date IS NULL))";
        $result = $this->db->query($sql,array($this->getCustservID()));
        return $result->result();
    }

// Clear Assigned Node IP Which were assigned to Customers on Current Date
    function clearAssignedNodeIPToCustomer(){
        $sql = "UPDATE node_detail SET customer_id = NULL, type_id = NULL,from_date = NULL WHERE node_detail_id = ?";
        $this->db->query($sql,array($this->getNodeDetailID()));
        return $this->db->affected_rows();
    }

// Clear Assigned Node IP Which were assigned to Customers on Previous Date
//    function clearAlreadyAssignedNodeIPToCustomer(){
//        $sql = "UPDATE node_detail SET to_date = CURDATE() WHERE node_detail_id = ?";
//        $sql1 = "INSERT INTO node_detail SELECT null,nodeip_id,parent_subnet,ip_addresses,null,null,null,null FROM node_detail WHERE node_detail_id=?";
//        $this->db->query($sql,array($this->getNodeDetailID()));
//        $this->db->query($sql1,array($this->getNodeDetailID()));
//        return $this->db->affected_rows();
//    }
        function clearAlreadyAssignedNodeIPToCustomer(){
        $sql = "UPDATE node_detail SET to_date = CURDATE(),remarks = ? WHERE node_detail_id = ?";
        $sql1 = "INSERT INTO node_detail SELECT null,nodeip_id,parent_subnet,ip_addresses,null,null,null,null,null FROM node_detail WHERE node_detail_id=?";
        $this->db->query($sql,array($this->getRemark(),$this->getNodeDetailID()));
        $this->db->query($sql1,array($this->getNodeDetailID()));
        return $this->db->affected_rows();
    }

//Get Categories details
    function getCategories(){
        $sql="SELECT * FROM category ORDER BY category_name";
        $result=$this->db->query($sql);
        return $result->result();
    }

//Get Subcategories for the Category
    function getSubCatByCategory(){
        $sql ="SELECT subcategory.sub_category_id,subcategory.ssid,subcategory.category_id FROM subcategory WHERE subcategory.category_id = ? ORDER BY subcategory.ssid";
        $result = $this->db->query($sql,array($this->getCategoryID()));
        return $result->result();
    }

//Get Category IP Details By Subcategory ID for Assigning to Customers
    function getCategoryIPDetailsBySubCatID(){
//        $sql= "SELECT category_ip.*,customers.* FROM category_ip LEFT JOIN customers ON category_ip.customer_id=customers.customer_id WHERE category_ip.sub_category_id = ? AND ((category_ip.from_date IS NULL AND category_ip.to_date IS NULL )OR (category_ip.from_date IS NOT NULL AND category_ip.to_date IS NULL)) ORDER BY INET_ATON( category_ip.ip_addresses ) ";
        $sql= "SELECT category_ip.*,tbl_customer.name FROM category_ip 
            LEFT JOIN (tbl_customer LEFT JOIN tbl_custservmaster
            ON tbl_customer.id=tbl_custservmaster.cust_id) ON category_ip.customer_id=tbl_custservmaster.id 
            WHERE category_ip.sub_category_id = ? 
            AND ((category_ip.from_date IS NULL 
            AND category_ip.to_date IS NULL )OR (category_ip.from_date IS NOT NULL 
            AND category_ip.to_date IS NULL)) 
            ORDER BY INET_ATON( category_ip.ip_addresses ) ";
        $result = $this->db->query($sql,array($this->getSubCatID()));
        if($result->num_rows() == 0) return 0;
        else return $result->result();

    }

//Get Category IP Details By Subcategory ID for Assigning to Customers :- Pagination
    function getCategoryIPDetailsBySubCatIDPage($per_page,$uri_segment){
        $sql= "SELECT category_ip.*,customers.* FROM category_ip LEFT JOIN customers ON category_ip.customer_id=customers.customer_id WHERE category_ip.sub_category_id = ? AND ((category_ip.from_date IS NULL AND category_ip.to_date IS NULL )OR (category_ip.from_date IS NOT NULL AND category_ip.to_date IS NULL)) ORDER BY INET_ATON( category_ip.ip_addresses ) LIMIT ".$uri_segment.",".$per_page."";
        $result = $this->db->query($sql,array($this->getSubCatID()));
        if($result->num_rows() == 0) return 0;
        else return $result->result();
    }

//Save CategoryIP details to Customer By using CustomerID
    function saveCategoryIPDetailsByCustID(){
        $i = 0 ;
        $bool = true;
        $ids=$this->getCategoryIPID();
        $cust = $this->getCustomerID();
        $custserv = $this->getCustservID();


            if( $custserv == 0 || sizeof($ids)== 0) $bool = false;

        if($bool){
            for($i = 0;$i<sizeof($ids);$i++){
                $sql = "UPDATE category_ip SET customer_id=".$custserv.",from_date= CURDATE(),status = 1 WHERE category_ip.ip_id=".$ids[$i]."";
                $this->db->query($sql);
            }
            return $this->db->affected_rows();
        }
        else return 0;

    }

//Get assigned CAtegory IPs details by Using Customer ID
    function getCategoryIPDetailsByCustomerID(){
        $sql ="SELECT category.*,subcategory.*,category_ip.*,customers.customer_id,customers.customer_name,customers.address,customers.connection_name,customers.bandwidth FROM category_ip LEFT JOIN customers ON customers.customer_id = category_ip.customer_id LEFT JOIN subcategory ON subcategory.sub_category_id = category_ip.sub_category_id LEFT JOIN category ON subcategory.category_id = category.category_id WHERE customers.customer_id=? AND ((category_ip.from_date IS NULL AND category_ip.to_date IS NULL )OR (category_ip.from_date IS NOT NULL AND category_ip.to_date IS NULL))";
        $result = $this->db->query($sql,array($this->getCustomerID()));
        return $result->result();
    }
// Editted for crm customers    
    function getCategoryIPDetailsByCustomerIDD(){
        $sql ="SELECT category. * , subcategory. * , category_ip. * , 
            tbl_custservmaster.link, tbl_custservmaster.identify, 
            tbl_custservmaster.ltown, tbl_service.name AS service_name
            FROM category_ip LEFT JOIN ( tbl_custservmaster
            LEFT JOIN tbl_service ON tbl_custservmaster.servicecode = tbl_service.servicecode ) 
            ON tbl_custservmaster.id = category_ip.customer_id
            LEFT JOIN subcategory ON subcategory.sub_category_id = category_ip.sub_category_id
            LEFT JOIN category ON subcategory.category_id = category.category_id
            WHERE tbl_custservmaster.cust_id =?
            AND ((category_ip.from_date IS NULL AND category_ip.to_date IS NULL)
            OR (category_ip.from_date IS NOT NULL AND category_ip.to_date IS NULL))";
        $result = $this->db->query($sql,array($this->getCustomerID()));
        return $result->result();
    }
    
    function getCategoryIPDetailsByCustservID(){
        $sql ="SELECT category.*,subcategory.*,category_ip.* FROM category_ip  LEFT JOIN subcategory ON subcategory.sub_category_id = category_ip.sub_category_id LEFT JOIN category ON subcategory.category_id = category.category_id WHERE category_ip.customer_id=? AND ((category_ip.from_date IS NULL AND category_ip.to_date IS NULL )OR (category_ip.from_date IS NOT NULL AND category_ip.to_date IS NULL))";
        $result = $this->db->query($sql,array($this->getCustservID()));
        return $result->result();
    }

// Clear Assigned Category IP Which were assigned to Customers on Current Date
    function clearAssignedCategoryIPToCustomer(){
        $sql = "UPDATE category_ip SET customer_id = NULL, status = 0 ,from_date = NULL WHERE category_ip.ip_id = ?";
        $this->db->query($sql,array($this->getCategoryIPID()));
        return $this->db->affected_rows();
    }

// Clear Assigned Category IP Which were assigned to Customers on Previous Date
//    function clearAlreadyAssignedCategoryIPToCustomer(){
//        $sql = "UPDATE category_ip SET to_date = CURDATE() WHERE category_ip.ip_id = ?";
//        $sql1 = "INSERT INTO category_ip SELECT category_id,sub_category_id,sub_pool_id,null,ip_addresses,subnet,0,null,null,null FROM category_ip WHERE category_ip.ip_id=?";
//        $this->db->query($sql,array($this->getCategoryIPID()));
//        $this->db->query($sql1,array($this->getCategoryIPID()));
//        return $this->db->affected_rows();
////        return $sql." : ".$sql1;
//    }
    
    function clearAlreadyAssignedCategoryIPToCustomer(){
        $sql = "UPDATE category_ip SET to_date = CURDATE(),remarks = ? WHERE category_ip.ip_id = ?";
        $sql1 = "INSERT INTO category_ip SELECT category_id,sub_category_id,sub_pool_id,null,ip_addresses,subnet,0,null,null,null,null FROM category_ip WHERE category_ip.ip_id=?";
        $this->db->query($sql,array($this->getRemark(),$this->getCategoryIPID()));
        $this->db->query($sql1,array($this->getCategoryIPID()));
        return $this->db->affected_rows();
//        return $sql1;
    }

//Check Whether Assigning Private Ips are already in the Database for the Same customer
    function checkExistPvtIPPerCustomerr(){
        $sql ="SELECT private_ip.ip_addresses,private_ip.customer_id FROM private_ip  WHERE customer_id = ? AND ip_addresses = ? AND to_date IS NULL";
//        $result = $this->db->query($sql,array($this->getCustomerID(),$this->getPvtIP()));
        $result = $this->db->query($sql,array($this->getCustservID(),$this->getPvtIP()));
//        if($result->num_rows() == 0) return 1;
//        else return 0;
        return $result;
    }
    
    function checkExistPvtIPPerCustomer(){
        $sql="SELECT private_ip.*,tbl_custservmaster.cust_id FROM private_ip LEFT JOIN tbl_custservmaster ON private_ip.customer_id=tbl_custservmaster.id
            WHERE tbl_custservmaster.cust_id=? AND private_ip.to_date IS NULL";
        $result=$this->db->query($sql,array($this->getCustomerID()));
        return $result->result();
    }

//Save Private IP details for the Customer By Customer ID
    function savePrivateIPByCustID(){
        $sql = "INSERT INTO private_ip(customer_id,subnet,ip_addresses,from_date) VALUES(?,?,?,?)";
//        $sql = "INSERT INTO private_ip(customer_id,subnet,ip_addresses,from_date) VALUES(".$this->getCustomerID().",".$this->getPvtCIDR().",".$this->getPvtIP().",".date('Y-m-d').")";
//        $this->db->query($sql,array($this->getCustomerID(),$this->getPvtCIDR(),$this->getPvtIP(),date("Y-m-d")));
        $this->db->query($sql,array($this->getCustservID(),$this->getPvtCIDR(),$this->getPvtIP(),date("Y-m-d")));
        return $this->db->affected_rows();
    }

//Get Private IP Details For the Customer By Customer ID
    function getPvtIPDetailsByCustomerID(){
        $sql ="SELECT private_ip.*,customers.customer_id,customers.customer_name,customers.address,customers.connection_name,customers.bandwidth FROM private_ip LEFT JOIN customers ON customers.customer_id = private_ip.customer_id  WHERE customers.customer_id=? AND ((private_ip.from_date IS NULL AND private_ip.to_date IS NULL )OR (private_ip.from_date IS NOT NULL AND private_ip.to_date IS NULL))";
        $result = $this->db->query($sql,array($this->getCustomerID()));
        return $result->result();
    }
    
//Editted for crm customers    
    function getPvtIPDetailsByCustomerIDD(){
        $sql ="SELECT private_ip. * ,tbl_custservmaster.link, tbl_custservmaster.identify, 
            tbl_custservmaster.ltown, tbl_service.name AS service_name
            FROM private_ip LEFT JOIN (tbl_custservmaster LEFT JOIN tbl_service 
            ON tbl_custservmaster.servicecode = tbl_service.servicecode) ON 
            tbl_custservmaster.id = private_ip.customer_id
            WHERE tbl_custservmaster.cust_id =?
            AND (( private_ip.from_date IS NULL AND private_ip.to_date IS NULL)
            OR ( private_ip.from_date IS NOT NULL AND private_ip.to_date IS NULL ))";
        $result = $this->db->query($sql,array($this->getCustomerID()));
        return $result->result();
    }
    
    function getPvtIPDetailsByCustservID(){
        $sql ="SELECT private_ip.* FROM private_ip  WHERE private_ip.customer_id=? AND ((private_ip.from_date IS NULL AND private_ip.to_date IS NULL )OR (private_ip.from_date IS NOT NULL AND private_ip.to_date IS NULL))";
        $result = $this->db->query($sql,array($this->getCustservID()));
        return $result->result();
    }

// Clear Assigned Private IP Which were assigned to Customers
    function deleteAssignedPrivateIPToCustomer(){
        $sql = "SELECT from_date FROM private_ip WHERE private_ip.pvt_ip_id = ?";
        $result  = $this->db->query($sql,array($this->getPvtIPID()));
        $result = $result->row_array();
        if(date("Y-m-d")== $result['from_date']){
            $sql = "DELETE FROM private_ip WHERE private_ip.pvt_ip_id = ?";
            $this->db->query($sql,array($this->getPvtIPID()));
            return $this->db->affected_rows();
        }
        else{
            $sql = "UPDATE private_ip SET private_ip.to_date = CURDATE() WHERE private_ip.pvt_ip_id = ?";
            $this->db->query($sql,array($this->getPvtIPID()));
            return $this->db->affected_rows();
        }
    }

//Check Whether New TEmporary Customer details are already existing in the database
    function checkExistTempCustomer(){
        $sql = "SELECT customers.customer_name,customers.status FROM customers WHERE customer_name = ? AND status IS NULL";
        $result = $this->db->query($sql,array($this->getCustomerName()));
        if($result->num_rows() == 0) return 1;
        else return 0;
    }

//Save Temporary Customer after checking Existence of same details in the customers table
    function saveTemporaryCustomer(){
        if($this->checkExistTempCustomer()){
        $sql="INSERT INTO customers(customer_name,connection_name,bandwidth,address,end_date,from_date) VALUES(?,?,?,?,?,?)";
        $this->db->query($sql,array($this->getCustomerName(),$this->getConnectionName(),$this->getBW(),$this->getAddress(),$this->getEndDate(),date('Y-m-d')));
        return $this->db->affected_rows();
        }
        else return 0;
    }

//Get Last Saved Temporary Customer Details-> In order to assign IPs
    function getLastTempCustDetailByCustName(){
        $sql="SELECT * FROM customers WHERE customer_name = ? AND status IS NULL";
        $result=$this->db->query($sql,array($this->getCustomerName()));
        return $result->result();
    }

//Remove TEmporary Customer -> set to_date to current date and set status 1 in customers and
// change in respective category_ip, nodeip, private_ip tables
    function deleteTemporaryCustomer(){
        $sql = "DELETE FROM private_ip WHERE private_ip.customer_id = ?";
        $sql1 = "UPDATE category_ip SET to_date = CURDATE() WHERE category_ip.customer_id = ?";
        $sql2 = "INSERT INTO category_ip SELECT category_id,sub_category_id,sub_pool_id,null,ip_addresses,subnet,0,null,null,null FROM category_ip WHERE category_ip.customer_id=?";
        $sql3 = "UPDATE node_detail SET to_date = CURDATE() WHERE node_detail.customer_id = ?";
        $sql4 = "INSERT INTO node_detail SELECT null,nodeip_id,parent_subnet,ip_addresses,null,null,null,null FROM node_detail WHERE node_detail.customer_id=?";
        $sql5 = "UPDATE customers SET status = 1 WHERE customers.customer_id  =?";

        $this->db->query($sql,array($this->getCustomerID()));
        $this->db->query($sql1,array($this->getCustomerID()));
        $this->db->query($sql2,array($this->getCustomerID()));
        $this->db->query($sql3,array($this->getCustomerID()));
        $this->db->query($sql4,array($this->getCustomerID()));
        $this->db->query($sql5,array($this->getCustomerID()));

        return $this->db->affected_rows();
    }

// Get End Date Per customer ID
    function getEndDateperID(){
        $sql = "SELECT customers.end_date FROM customers WHERE customers.customer_id = ?";
        $result = $this->db->query($sql,array($this->getCustomerID()));
        return $result->row_array();
    }

//Get Temporary Allocation Termination Details for the notification
    function getTempAllocationTerminations(){
        $sql = "SELECT * FROM customers WHERE end_date <= curdate( )AND STATUS IS NULL";
        $result = $this->db->query($sql);
        return $result->result();
    }
}