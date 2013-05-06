 <?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 /*
  * Controller : Category
  * Functions:  addCategory, modifyCategory, saveCategory, saveSubCategory, deleteCategory
  *             delete SubCategory, editCategory, editSubCategory, updateCategory, updateSubCategory,
  *             showLocationDetails, deleteLocation,addNodeLocation , addNodeType, deleteNodeType
  *
  * Help: Hierarchy
  * Category -> SubCategory
  * * Node is the Default Category, having Category_id = 1;
  * * Node has location based SSIDs for IP allocations;
  * * Node type is selected while Node IPs are assigned to Customers;
  *
  * */

 class Category extends CI_Controller{
        function __construct(){
                parent::__construct();
            $this->load->model('category_model');
            $this->load->library('pagination');
            $this->load->library('table');

        }
//index function call of the category controller
        public function index(){
            if($this->session->userdata('Logged_In')) {
                $this->load->model('category_model');
                redirect('category/addCategory');
            }
            else $this->load->view('login/login');
        }

//Function to load 'add Category' page
        public function addCategory(){
            if($this->session->userdata('Logged_In')){
               $data['title']="Add Category";
                $data['location_details'] = $this->category_model->getLocationTable();
                $data['nodetype_details'] = $this->category_model->getNodeTypeTable();
                $partials = array('content'=>'category/add_category');
                $this->template->load('template/simpla_template',$partials,$data);
            }
            else $this->load->view('login/login');
        }
//Function to saveCategory names to the system
        public function saveCategory(){
            if (!isset($_SERVER['HTTP_X_REQUESTED_WITH']))
            {
                redirect('category/addCategory');
            }
            else{
            $this->category_model->setCategoryName($this->input->post('cat_name'));
             if($this->category_model->validateCategory()){
                 $this->category_model->saveCategory();
                 echo '1';

             }
             else echo '0';
            }
        }

//Function to save subCategory names to the system
     public function saveSubCategory(){
            if (!isset($_SERVER['HTTP_X_REQUESTED_WITH']))
            {
                redirect('category/addCategory');
            }
            else{
                $this->category_model->setCategoryID($this->input->post('cat_id'));
                $this->category_model->setSSID($this->input->post('subcat_name'));
                $location = $this->input->post('location');
                $this->category_model->setLocationID($location);
                if ($location > 0){
                    if($this->category_model->validateSubNodeCategory()){
                        $this->category_model->saveSubNodeCategory();
                        echo '1';
                    }
                    else echo '0';
                }
                else{
                    if($this->category_model->validateSubCategory()){
                        $this->category_model->saveSubCategory();
                        echo '1';
                    }
                    else echo '0';

                }
            }

        }

//Function to load modify Category page => displays Categories & Subcategories details
     public function modifyCategory(){
            if($this->session->userdata('Logged_In')){

                    $config['base_url'] = base_url() . 'index.php/category/modifyCategory';
                    $config['total_rows'] = count($this->category_model->getSubCategory());
                    $config['per_page'] = 10;

                    $this->pagination->initialize($config);

                    $data['subcategory'] = $this->category_model->getSubCategory();

                $data['title']="View/Modify Categories";
                $partials = array('content'=>'category/modify_category');
                $this->template->load('template/simpla_template',$partials,$data);
            }
            else $this->load->view('login/login');
        }

//Function to Delete Category names => Subcategories should be deleted first condition is checked.
     public function deleteCategory(){
            if($this->session->userdata('Logged_In')){
                if (!isset($_SERVER['HTTP_X_REQUESTED_WITH'])){

                redirect('category/modifyCategory');
                }

                else{
                $this->category_model->setCategoryID($this->input->post('cat_id'));
                $this->category_model->deleteCategoryByID();
            }}
            else $this->load->view('login/login');
          }

//Function to delete sub category/ssid names
     public function deleteSubCategory(){

            if($this->session->userdata('Logged_In')){
                if (!isset($_SERVER['HTTP_X_REQUESTED_WITH'])){

                    redirect('category/modifyCategory');
                }

                else{
                    $this->category_model->setCategoryID($this->input->post('cat_id'));
                    $this->category_model->setSubCatID($this->input->post('sub_cat_id'));
                    if($this->category_model->deleteSubCatByID())
                        echo '1';
                    else
                        echo '0';

                }
                }
            else{
                $this->load->view('login/login');
            }
        }

//Function to edit Category names
     public function editCategory($category_id){
            if($this->session->userdata('Logged_In')){

                $this->category_model->setCategoryID($category_id);
                $data['title']= "Edit Category";
                $result= $this->category_model->getCategoryData();
                foreach($result as $row){
                    $data['category_id']=$row->category_id;
                    $data['category_name']=$row->category_name;
                }
                $partials=array('content'=>'category/edit_category');
                $this->template->load('template/simpla_template',$partials,$data);
            }
            else $this->load->view('login/login');

        }
//Function to update Modification to Category Name
        public function updateCategory(){
            if($this->session->userdata('Logged_In')){

                if (!isset($_SERVER['HTTP_X_REQUESTED_WITH'])){

                redirect('category/modifyCategory');
            }

            else{
                $this->category_model->setCategoryID($this->input->post('cat_id'));
                $this->category_model->setCategoryName($this->input->post('cat_name'));
                $this->category_model->updateCategory();
            }
        }


        }

//Function to edit Sub Category names
     public function editSubCategory($sub_category_id){
            if($this->session->userdata('Logged_In')){

                $this->category_model->setSubCatID($sub_category_id);
                $data['title']= "Edit Sub Category";
                $result= $this->category_model->getSubCategoryData();
                foreach($result as $row){
                    $data['category_id']=$row->category_id;
                    $data['category_name']=$row->category_name;
                    $data['sub_category_id'] = $row->sub_category_id;
                    $data['ssid'] = $row->ssid;
                    $data['location'] = $row->location;
                }
                $partials=array('content'=>'category/edit_subcategory');
                $this->template->load('template/simpla_template',$partials,$data);
            }
            else $this->load->view('login/login');

        }

//Function to update Modification to sub Category Names
     public function updateSubCategory(){
            if($this->session->userdata('Logged_In')){

                if (!isset($_SERVER['HTTP_X_REQUESTED_WITH'])){

                    redirect('category/modifyCategory');
                }

                else{
                    $this->category_model->setSubCatID($this->input->post('sub_cat_id'));
                    $this->category_model->setSSID($this->input->post('ssid'));
                    $this->category_model->setLocation($this->input->post('location'));

                    $this->category_model->updateSubCategory();
                }
            }
            else $this->load->view('login/login');


        }
//Function to return SSID details for a Location
        public function showLocationDetails(){
            if($this->session->userdata('Logged_In')){

                if (!isset($_SERVER['HTTP_X_REQUESTED_WITH'])){

                    redirect('category/addCategory');
                }
                else{
                    $this->category_model->setLocationID($this->input->post('location_id'));
                    $data['location'] = $this->category_model->getLocationByID($this->input->post('location_id'));
                    $data['ssid_location_details']= $this->category_model->getSSIDByLocationID();
                    $this->load->view('category/view_ssid_location',$data);
                }
            }
            else $this->load->view('login/login');

        }

//Functions to Delete location
        public function deleteLocation(){
                if($this->session->userdata('Logged_In')){

                    if (!isset($_SERVER['HTTP_X_REQUESTED_WITH'])){

                        redirect('category/addCategory');
                    }
                    else{
                        $this->category_model->setLocationID($this->input->post('location_id'));
                        $check = $this->category_model->deleteLocationByID();
                        if($check) echo '1'; else echo '0';
                    }
                    }
                else $this->load->view('login/login');
        }

//Function to add Node Locations
        public function addNodeLocation(){
            if($this->session->userdata('Logged_In')){

                if (!isset($_SERVER['HTTP_X_REQUESTED_WITH'])){

                    redirect('category/addCategory');
                }

                else{
                    $this->category_model->setLocationn($this->input->post('location'));
                    $check = $this->category_model->addNodeLocation();
                    if($check) echo '1'; else echo '0';

                }
            }
            else $this->load->view('login/login');
        }

//Add node types :-> reply to ajax call
        public function addNodeType(){
            if($this->session->userdata('Logged_In')){

                if (!isset($_SERVER['HTTP_X_REQUESTED_WITH'])){

                    redirect('category/addCategory');
                }

                else{
                    $this->category_model->setNodeType($this->input->post('node_type'));
                    $check = $this->category_model->addNodeType();
                    if($check) echo '1'; else echo '0';

                }
            }
            else $this->load->view('login/login');
        }

//Delete Node Types :-> cannot be deleted if node types are assigned to customers
        public function deleteNodeType(){
            if($this->session->userdata('Logged_In')){

                if (!isset($_SERVER['HTTP_X_REQUESTED_WITH'])){

                    redirect('category/addCategory');
                }
                else{
                    $this->category_model->setNodeTypeID($this->input->post('type_id'));
                    $check = $this->category_model->deleteNodeTypeByID();
                    if($check) echo '1'; else echo '0';
                }
            }
            else $this->load->view('login/login');

        }

 }

 ?>
