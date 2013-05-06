<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by JetBrains PhpStorm.
 * User: DELL
 * Date: 7/11/12
 * Time: 4:06 PM
 * To change this template use File | Settings | File Templates.
 */
class Home_controller extends CI_Controller{

    public function __construct(){
        parent::__construct();
        $this->load->library('pagination');
        $this->load->library('table');

        $this->load->model('category_model');
        $this->load->helper('url');
    }

    public function index(){
        $data['title']="Home";
        $partials = array('content'=>'home');
        $this->template->load('template/simpla_template',$partials,$data);
    }

    public function pagination_check(){

        $data['title'] = 'Pagination Checkup';
        $this->load->library('pagination');
        $this->load->library('table');
        $this->load->model('category_model');
        $this->load->helper('url');
        $config['base_url'] = base_url() . 'index.php/home_controller/pagination_check';
        $config['total_rows'] = count($this->category_model->getSubCategory());
        $config['per_page'] = 5;
        $config['full_tag_open'] = '<p>';
        $config['full_tag_close'] = '</p>';

        $this->pagination->initialize($config);

        $data['results'] = $this->category_model->getSubCategories($config['per_page'],$this->uri->segment(3,0));

        $partials = array('content'=>'customers/add_customer');

        $this->template->load('template/simpla_template', $partials, $data);
    }


}

?>