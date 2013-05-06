<?php
/**
 * Date         User        Dtails
 * 21-Aug-12    Brinthan    INitialize Search Model
 */

class Search_Model extends CI_Model{
    function Customer_Model(){
        parent::__construct();
        $this->load->model('customer_model');
    }

    private $CUSTOMER,$CATEGORY,$IP;
    public function getCustSearch(){return $this->CUSTOMER;}
    public function getCatSearch(){return $this->CATEGORY;}
    public function getIPSearch(){return $this->IP;}

    public function setCustSearch($x){$this->CUSTOMER = $x;}
    public function setCatSearch($x){$this->CATEGORY = $x;}
    public function setIPSearch($x){$this->IP = $x;}


    function searchCustomer(){
        $sql = "SELECT * FROM customers  WHERE (customer_name LIKE '%".$this->getCustSearch()."%' OR address LIKE '%".$this->getCustSearch()."%' OR connection_name LIKE '%".$this->getCustSearch()."%' )AND customers.status IS NULL";
        $result = $this->db->query($sql);
        return json_encode($result->result());
    }
    function searchCustomerr(){
        $search=$this->getCustSearch();
        $search = $this->search_split_terms($search);
	$terms_db = $this->search_db_escape_terms($search);
	$parts = array();
	$partss = array();

	foreach($terms_db as $term_db){

		$parts[] = "CONCAT(customer_name, ' ', address, ' ', connection_name) RLIKE '$term_db'";
	}       
	$parts = implode(' AND ', $parts); 
        
	foreach($terms_db as $term_db){

		$partss[] = "CONCAT(tbl_customer.name, ' ', tbl_custservmaster.identify, ' ', tbl_custservmaster.location) RLIKE '$term_db'";
	}       
	$partss = implode(' AND ', $partss);        
        $sql1 = "SELECT * FROM customers  WHERE $parts AND customers.status IS NULL";       
//        $sql2 = "SELECT DISTINCT tbl_customer.id, tbl_customer.name,
//tbl_custservmaster.identify,tbl_custservmaster.id 
//FROM tbl_customer, tbl_custservmaster
//WHERE (tbl_customer.id = tbl_custservmaster.cust_id) AND 
//(tbl_customer.name LIKE '%".$this->getCustSearch()."%'
//OR tbl_custservmaster.identify LIKE '%".$this->getCustSearch()."%')";
        $sql2="SELECT tbl_custservmaster.id, tbl_custservmaster.cust_id, tbl_customer.name, tbl_custservmaster.identify, tbl_custservmaster.link, tbl_custservmaster.serialno, tbl_custservmaster.ltown, tbl_custservmaster.location, tbl_service.name AS service_name, tbl_service.servicecode
FROM tbl_custservmaster
LEFT JOIN tbl_customer ON tbl_customer.id = tbl_custservmaster.cust_id
LEFT JOIN tbl_service ON tbl_custservmaster.servicecode = tbl_service.servicecode
WHERE $partss
AND tbl_customer.id IS NOT NULL
AND tbl_custservmaster.servicecode
IN (
'LN', 'IH', 'M'
)";
        $result = mysql_query( $sql1 ) or die();
        if($result){
        $result1 = $this->db->query($sql1)->result();
        $result2 = $this->db->query($sql2)->result();
        }
        return array($result1,$result2);
//        return $sql2;
    }

    function searchCatSSID(){
        $sql = "SELECT * FROM category INNER JOIN subcategory ON category.category_id = subcategory.category_id WHERE subcategory.ssid LIKE '%".$this->getCatSearch()."%' OR category.category_name LIKE '%".$this->getCatSearch()."%' OR subcategory.location LIKE '%".$this->getCatSearch()."%' ";
        $result = $this->db->query($sql);
        return json_encode($result->result());
    }


    function searchPrimaryPool(){
        $sql = "SELECT * FROM ippool LEFT JOIN primary_sub_pool ON primary_sub_pool.pool_id = ippool.pool_id WHERE primary_sub_pool.sub_pool_values LIKE '%".$this->getIPSearch()."%'";
        $result = $this->db->query($sql);
        return ($result->result());
    }

    function searchNodeIP(){
        $sql = "SELECT customers.status AS cust_status,customers.customer_name,customers.customer_id,customers.from_date AS cust_from_date,customers.end_date AS cust_to_date,nodeip.subnet,nodeip.category_id,nodeip.sub_category_id,nodeip.from_date AS node_from_date,nodeip.to_date AS node_to_date,nodeip.ip_id,nodeip.ip_addresses AS nodeip_add, node_detail.ip_addresses,node_detail.customer_id,node_detail.to_date,node_detail.from_date,node_detail.parent_subnet,subcategory.location_id,subcategory.location,subcategory.ssid
         FROM nodeip LEFT JOIN node_detail ON nodeip.ip_id = node_detail.nodeip_id LEFT JOIN customers ON customers.customer_id = node_detail.customer_id LEFT JOIN subcategory ON subcategory.sub_category_id = nodeip.sub_category_id WHERE nodeip.ip_addresses LIKE '%".$this->getIPSearch()."%' OR node_detail.ip_addresses LIKE '%".$this->getIPSearch()."%'";
        $result = $this->db->query($sql);
        return ($result->result());
    }

    function searchCategoryIP(){
        $sql = "SELECT category.*,customers.status AS cust_status,customers.customer_name,customers.customer_id,customers.from_date AS cust_from_date,customers.end_date AS cust_to_date,category_ip.*,subcategory.sub_category_id,subcategory.ssid FROM category_ip LEFT JOIN subcategory ON subcategory.sub_category_id = category_ip.sub_category_id LEFT JOIN category ON category.category_id = subcategory.category_id LEFT JOIN customers ON customers.customer_id = category_ip.customer_id WHERE category_ip.ip_addresses LIKE '%".$this->getIPSearch()."%' ";
        $result = $this->db->query($sql);
        return ($result->result());
    }

    function searchPrivateIP(){
        $sql = "SELECT customers.status AS cust_status,customers.customer_name,customers.customer_id,customers.from_date AS cust_from_date,customers.end_date AS cust_to_date,private_ip.* FROM private_ip LEFT JOIN customers ON customers.customer_id = private_ip.customer_id WHERE private_ip.ip_addresses LIKE '%".$this->getIPSearch()."%' ";
        $result = $this->db->query($sql);
        return ($result->result());
    }
    
/*************************************REFINE SEARCH*********************************************************/
    function search_split_terms($terms){

		$terms = preg_replace("/\"(.*?)\"/e", "search_transform_term('\$1')", $terms);
//		split on whitespaces and commas
                $terms = preg_split("/\s+|,/", $terms);

		$out = array();

		foreach($terms as $term){

			$term = preg_replace("/\{WHITESPACE-([0-9]+)\}/e", "chr(\$1)", $term);
			$term = preg_replace("/\{COMMA\}/", ",", $term);
			$out[] = $term;
		}

		return $out;
	}
  // function to replace ',' to {COMMA} and white spaces to {WHITESPACE-32}        
	function search_transform_term($term){
		$term = preg_replace("/(\s)/e", "'{WHITESPACE-'.ord('\$1').'}'", $term);
		$term = preg_replace("/,/", "{COMMA}", $term);
		return $term;
	}      
        
/*
 * we need to make sure each term matches on word boundaries so that 'foo' 
 * matches 'a foo a' but not 'a food a'. 
 * In MySQL syntax, these are '[[:<:]]' and '[[:>:]]'. 
 */        
        function search_db_escape_terms($terms){
		$out = array();
		foreach($terms as $term){
//			$out[] = '[[:<:]]'.AddSlashes($this->search_escape_rlike($term)).'[[:>:]]';
			$out[] = '[[:<:]]'.AddSlashes($this->search_escape_rlike($term));
		}
		return $out;
	}


//  escape MySQL regular expression meta-character   
//  This function inserts a slash before each meta-character that MySQL uses.
        	function search_escape_rlike($string){
		return preg_replace("/([.\[\]*^\$])/", '\\\$1', $string);
	}
/************************************REFINE SEARCH****************************************************************/  
    
    

}