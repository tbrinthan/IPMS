<?php
/* Date         Name        Description
 * 25Jul2012    Brinthan    Initial version- to maintain the categories. uaes ta_
 * 26Jul
 *
 */
class Category_Model extends CI_Model{
    private $CATEGORY_ID,$CATEGORY_NAME,$SUB_CAT_ID,$SSID ,$LOCATION,$LOCATIONN,$LOCATION_ID,$NODE_TYPE,$NODE_TYPE_ID;

    function __construct(){
       parent::__construct();
    }
    public function getCategoryID(){return $this->CATEGORY_ID;}
    public function getCategoryName(){return $this->CATEGORY_NAME;}
    public function getSubCatID(){return $this->SUB_CAT_ID;}
    public function getSSID(){return $this->SSID;}
    public function getLocation(){return $this->LOCATION;}
    public function getLocationn(){return $this->LOCATIONN;}
    public function getLocationID(){return $this->LOCATION_ID;}
    public function getNodeType(){return $this->NODE_TYPE;}
    public function getNodeTypeID(){return $this->NODE_TYPE_ID;}

    public function setCategoryID($x){$this->CATEGORY_ID = $x;}
    public function setCategoryName($x){$this->CATEGORY_NAME = $x;}
    public function setSubCatID($x){$this->SUB_CAT_ID = $x;}
    public function setSSID($x){$this->SSID = $x;}
    public function setLocation($x){$this->LOCATION = $x;}
    public function setLocationn($x){$this->LOCATIONN = $x;}
    public function setLocationID($x){$this->LOCATION_ID = $x;}
    public function setNodeType($x){$this->NODE_TYPE = $x;}
    public function setNodeTypeID($x){$this->NODE_TYPE_ID = $x;}

//Get all details from category table
    public  function getCategory(){
        $sql = "SELECT * FROM category";
        $result = $this->db->query($sql);
        return $result->result();
    }

//Get Category details by CategoryID
    function getCategoryData(){
        $sql="SELECT * FROM category WHERE category_id=?";
        $result=$this->db->query($sql,array($this->getCategoryID()));
        return $result->result();
    }

//to check if the category already exists in the database
    function validateCategory(){
        $sql="SELECT * FROM category WHERE category_name=?";
        $result = $this->db->query($sql,array($this->getCategoryName()));
        if($result->num_rows() != 1) return 1 ; //checking if any row exist
        else return 0;
    }

//Get all Subcategory table details =>joined with category table
    public function getSubCategory(){
        $sql = "SELECT * FROM category RIGHT JOIN subcategory ON subcategory.category_id = category.category_id ORDER BY subcategory.category_id,subcategory.location,subcategory.ssid";
        $result = $this->db->query($sql);
        return $result->result();
    }

//Get all Subcategory table details =>joined with category table -> LIMIT given-> Pagination
    public function getSubCategories($per_page,$uri_segment){
        $sql = "SELECT * FROM category RIGHT JOIN subcategory ON subcategory.category_id = category.category_id ORDER BY subcategory.category_id,subcategory.location,subcategory.ssid LIMIT ".$uri_segment.",".$per_page."";
        $result = $this->db->query($sql);
        return $result->result();
    }

//Get Subcategory details By SubcategoryID
    function getSubCategoryData(){
        $sql = "SELECT * FROM category RIGHT JOIN subcategory ON subcategory.category_id = category.category_id WHERE subcategory.sub_category_id=?";
        $result=$this->db->query($sql,array($this->getSubCatID()));
        return $result->result();
    }

//Check if any subcategories are already assigned on same Name
    function validateSubCategory(){
        $sql="SELECT * FROM subcategory WHERE ssid=? AND category_id = ? AND location_id IS NULL ";
        $result = $this->db->query($sql,array($this->getSSID(),$this->getCategoryID()));
        if($result->num_rows() != 1) return 1 ;
        else return 0;
    }

//Check if any SSIDs are already assigned on same Name
    function validateSubNodeCategory(){
        $sql="SELECT * FROM subcategory WHERE ssid=? AND category_id = ? AND location_id=? ";
        $result = $this->db->query($sql,array($this->getSSID(),$this->getCategoryID(),$this->getLocationID()));
        if($result->num_rows() != 1) return 1 ;
        else return 0;
    }

//Save category Name details ot database
    public function saveCategory(){
        $sql = "INSERT INTO category (category_name) VALUES(?)";
        $this->db->query($sql, array($this->getCategoryName()));
        return $this->db->affected_rows();
    }

//Save SSIDs Names to  database
    public function saveSubNodeCategory(){
        $sql = "INSERT INTO subcategory(category_id,ssid,location,location_id) VALUES(?,?,?,?)";
        $loc = $this->getLocationByID();
        $this->db->query($sql, array($this->getCategoryID(),
            $this->getSSID(),
            $loc['location'],
            $this->getLocationID()
        ));
        return $this->db->affected_rows();
    }

//Save Subcategories Name to database
    public function saveSubCategory(){
        $sql = "INSERT INTO subcategory(category_id,ssid,location,location_id) VALUES(?,?,?,?)";
        $this->db->query($sql, array($this->getCategoryID(),
            $this->getSSID(),
            null,
            null
        ));
        return $this->db->affected_rows();
    }

//Delete Category Name by Category ID
    public function deleteCategoryByID(){
        $check = $this->getSubCategory();
        $bool = true;
        foreach($check as $row){
            if($row->category_id == $this->getCategoryID()){
                $bool = false;
            }
        }
        if($bool==true){

            $sql = "DELETE FROM category WHERE category_id = ?";
            $this->db->query($sql,array($this->getCategoryID()));
            echo '1';
            return $this->db->affected_rows();
            exit;

        }
    }


    public function checkSubCatAssigned(){
        $sql = "SELECT nodeip.sub_category_id AS nodesub FROM nodeip LEFT JOIN subcategory ON nodeip.sub_category_id = subcategory.sub_category_id WHERE subcategory.sub_category_id = ?  ";
        $sql1 = "SELECT category_ip.sub_category_id AS catsub FROM category_ip LEFT JOIN subcategory ON category_ip.sub_category_id = subcategory.sub_category_id WHERE subcategory.sub_category_id = ?  ";
        $res = $this->db->query($sql,array($this->getSubCatID()));
        $res1 = $this->db->query($sql1,array($this->getSubCatID()));

        if($res->num_rows() == 0 && $res1->num_rows() == 0) return 1;
        else return 0;
    }

//Delete Subcateogry by SubcategoryID
    public function deleteSubCatByID(){
        if ($this->checkSubCatAssigned()) {
            $sql = "DELETE FROM subcategory WHERE sub_category_id = ? AND category_id=?";
            $this->db->query($sql, array($this->getSubCatID(), $this->getCategoryID()));
            return $this->db->affected_rows();
        } else
            return 0;

    }

//Update Category Name changes
    public function updateCategory(){
        $sql="UPDATE category SET category_name=? WHERE category_id =?";
        $this->db->query($sql,array($this->getCategoryName(),$this->getCategoryID()));
        echo '1';

        return $this->db->affected_rows();
    }

//Update Subcategory Name changes
    public function updateSubCategory(){
        $sql="UPDATE subcategory SET ssid=?,location=? WHERE sub_category_id =?";
        $this->db->query($sql,array($this->getSSID(),$this->getLocation(),$this->getSubCatID()));
        echo '1';

        return $this->db->affected_rows();
    }

//Get Location details
    public function getLocationTable(){
        $sql="SELECT * FROM location ORDER BY location";
        $result = $this->db->query($sql);
        return $result->result();
    }

//Get SSID by Location ID
    public function getSSIDByLocationID(){
        $sql = "SELECT subcategory.sub_category_id,subcategory.ssid,subcategory.location_id,location.location FROM subcategory JOIN location ON subcategory.location_id = location.location_id WHERE location.location_id = ? ";
        $result=$this->db->query($sql,array($this->getLocationID()));
        return $result->result();
    }

//Check Whether Inputted Location is already in the database
    public function checkSSIDLocationAssign(){
        $sql = "SELECT subcategory.location_id,location.location_id FROM subcategory LEFT JOIN location ON subcategory.location_id = location.location_id WHERE location.location_id = ?";
        $result = $this->db->query($sql,array($this->getLocationID()));
        if($result->num_rows() == 0) return 1;
        else return 0;
    }

//Delete Location by Location ID
    public function deleteLocationByID(){
        if($this->checkSSIDLocationAssign()){
        $sql = "DELETE FROM location WHERE location_id = ?";
        $this->db->query($sql,array($this->getLocationID()));
        return $this->db->affected_rows();
        }
        else return 0;
    }

//Get Location Name by Location ID
    public function getLocationByID(){
        $sql ="SELECT location.location from location WHERE location.location_id = ?";
        $result = $this->db->query($sql,array($this->getLocationID()));
        return $result->row_array();
    }

//Insert Node Location names
    public function addNodeLocation(){
        $sql = "SELECT location.location FROM location WHERE location =?";
        $result = $this->db->query($sql,array($this->getLocationn()));
        if($result->num_rows() == 0){
            $sql1 = "INSERT INTO location(location) VALUES(?)";
            $results= $this->db->query($sql1,array($this->getLocationn()));
            return $this->db->affected_rows();
        }
        else
           return 0;
    }

//Insert Node TYpe details
    public function addNodeType(){
        $sql = "SELECT * FROM node_type WHERE Type_name =?";
        $result = $this->db->query($sql,array($this->getNodeType()));
        if($result->num_rows() == 0){
            $sql1 = "INSERT INTO node_type(Type_name) VALUES(?)";
            $this->db->query($sql1,array($this->getNodeType()));
            return $this->db->affected_rows();
        }
        else
           return 0;

    }

//Get all node type details
    public function getNodeTypeTable(){
        $sql="SELECT * FROM node_type ";
        $result = $this->db->query($sql);
        return $result->result();
    }

//Check whether Inputted Node types already exist in the node type table
    public function checkExistingNodeType(){
        $sql="SELECT node_detail.Type_id FROM node_detail WHERE node_detail.Type_id =?";
        $result = $this->db->query($sql,array($this->getNodeTypeID()));
        if($result->num_rows()== 0) return 1;
        else return 0;
    }

//Delete Node Type by Nodetype ID
    public function deleteNodeTypeByID(){
        if($this->checkExistingNodeType()){
            $sql = "DELETE FROM node_type WHERE Type_id = ?";
            $this->db->query($sql,array($this->getNodeTypeID()));
            return $this->db->affected_rows();
        }
        else return 0;
    }





}




?>