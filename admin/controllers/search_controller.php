<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Date         User        Details
 * 21-Aug-12    Brinthan    Search controller initialization
 */
class Search_Controller extends CI_Controller {

    function Search_Controller() {
        parent::__construct();
        $this->load->model('search_model');
        $this->load->model('customer_model');
        $this->load->library('pagination');
    }

    function MainSearch() {
        if ($this->session->userdata('Logged_In')) {
            $data['title'] = "Search";
            $partials = array('content' => 'search/search');
            $this->template->load('template/simpla_template', $partials, $data);
        }
        else
            $this->load->view('login/login');
    }

    function customerSearch() {
        if ($this->session->userdata('Logged_In')) {
            if (!isset($_SERVER['HTTP_X_REQUESTED_WITH'])) {
                redirect('search_controller/MainSearch');
            } else {
                $this->search_model->setCustSearch(($this->input->post('search')));
                $result = $this->search_model->searchCustomer();
                echo $result;
            }
        }
        else
            $this->load->view('login/login');
    }

    function customerSearch1() {
        if ($this->session->userdata('Logged_In')) {
            if (!isset($_SERVER['HTTP_X_REQUESTED_WITH'])) {
                redirect('search_controller/MainSearch');
            } else {
                $search = $this->input->post('search');
                $this->search_model->setCustSearch($search);
 		
        
        
                list($result1, $result2) = $this->search_model->searchCustomerr();
//                print_r($result2); 
//                return;
                echo '<div class="result">';
                echo '<ul class="search-results">';
                if (!empty($result1)) {
                    foreach ($result1 as $row) {
                        echo '<li>';
                        if ($row->end_date != null) {
                            echo '<h2><a href="' . base_url() . 'index.php/customer_controller/viewTempCustomer/' . $row->customer_id . '">' .ucwords(strtolower( $row->customer_name)). '</a></h2>';
                            echo '<p>' .ucwords(strtolower($row->address)). '</p>';  
                        }
                        echo '</li>';
                    }
                }
                
                if (!empty($result2)) {
                    foreach ($result2 as $row) {
                        echo '<li>';
                        echo '<h2><a href="' . base_url() . 'index.php/customer_controller/viewCustomer/' . $row->cust_id .'/'.$row->id.'">' .ucwords(strtolower($row->name)). '</a></h2>';
                        if($row->link == 0)
                            echo '<p>'.$row->service_name.'</p>';
                        else
                            echo '<p>Link('.$row->link.')</P>';
                        if(strtolower($row->location)=="none")
                        {                            
                            echo '<p>'.ucwords(strtolower($row->identify)). '</p>' ;
                        }
                            
                        else
                            echo '<p>' .ucwords(strtolower($row->location)). '</p>';
                        echo '</li>';
                    }
                }
                echo '<p></p>';
                echo '</ul>';
                echo '</div>';
            }
        }
        else
            $this->load->view('login/login');
    }
      

    function categorySearch() {
        if ($this->session->userdata('Logged_In')) {
            if (!isset($_SERVER['HTTP_X_REQUESTED_WITH'])) {
                redirect('search_controller/MainSearch');
            } else {
                $this->search_model->setCatSearch(($this->input->post('search')));
                $result = $this->search_model->searchCatSSID();
                echo $result;
            }
        }
        else
            $this->load->view('login/login');
    }

    function ipBlockSearch() {
        if ($this->session->userdata('Logged_In')) {
            if (!isset($_SERVER['HTTP_X_REQUESTED_WITH'])) {
                redirect('search_controller/MainSearch');
            } else {
                $search = $this->input->post('search');
                $this->search_model->setIPSearch($search);
                $result = $this->search_model->searchNodeIP();
                $result1 = $this->search_model->searchCategoryIP();
                $chk = array();
                $chk1 = array();

                echo '<div class="result">';
                echo '<ul class="search-results">';


                if (empty($result)) {
                    if (filter_var($search, FILTER_VALIDATE_IP)) {
                        $parts = explode('.', $search);
                        $search1 = $parts[0] . '.' . $parts[1] . '.' . $parts[2];
                        $this->search_model->setIPSearch($search1);
                        $result2 = $this->search_model->searchCategoryIP();
                        foreach ($result2 as $row) {
                            $ip = ip2long($search);
                            $mask = ~((1 << (32 - $row->subnet)) - 1);
                            $nw1 = ip2long($row->ip_addresses);
                            $nw2 = $ip & $mask;
                            if ($nw1 == $nw2 && $ip != $nw1) {
                                if ($row->customer_id != NULL && $row->status == 1 && $row->cust_status != 1) {
                                    echo '<li>';
                                    if ($row->cust_status == NULL && $row->cust_to_date == NULL) {
                                        echo '<h2><a href="' . base_url() . 'index.php/customer_controller/viewCustomer/' . $row->customer_id . '">' . $row->customer_name . '</a></h2>';
                                    } else if ($row->cust_to_date != NULL && $row->cust_status == NULL) {
                                        echo '<h2><a href="' . base_url() . 'index.php/customer_controller/viewTempCustomer/' . $row->customer_id . '">' . $row->customer_name . '</a></h2>';
                                    }
                                    echo '<p>' . str_ireplace($search, '<span class = "highlight">' . $search . '</span>', $row->ip_addresses) . ' /' . $row->subnet . '</p>';
                                    echo '<a href="#" class=\"readMore\">Read more..</a>';
                                    echo '</li>';
                                } else if ($row->status == 0 && $row->to_date == NULL) {
                                    echo '<li>';
                                    echo '<h2><a href="' . base_url() . 'index.php/ipblock_controller/assigned_ipblocks/' . $row->category_id . '/' . $row->sub_category_id . '">' . $row->ssid . '</a></h2>';
                                    echo '<p>' . str_ireplace($search, '<span class = "highlight">' . $search . '</span>', $row->ip_addresses) . ' /' . $row->subnet . '</p>';
                                    echo '<a href="#" class=\"readMore\">Read more..</a>';
                                    echo '</li>';
                                }
                            }
                        }
                    }
                }



                foreach ($result as $row) {

                    if ($row->customer_id != NULL && $row->cust_status != 1 && $row->to_date == NULL) {
                        echo '<li>';
                        echo '<p>';
                        if ($row->cust_status == NULL && $row->cust_to_date == NULL) {
                            echo '<h2><a href="' . base_url() . 'index.php/customer_controller/viewCustomer/' . $row->customer_id . '">' . $row->customer_name . '</a></h2>';
                        } else if ($row->cust_to_date != NULL && $row->cust_status == NULL) {
                            echo '<h2><a href="' . base_url() . 'index.php/customer_controller/viewTempCustomer/' . $row->customer_id . '">' . $row->customer_name . '</a></h2>';
                        }
                        echo '<p>' . str_ireplace($search, '<span class = "highlight">' . $search . '</span>', $row->ip_addresses) . '</p>';
                        echo '<p>' . str_ireplace($search, '<span class = "highlight">' . $search . '</span>', $row->nodeip_add) . ' /' . $row->parent_subnet . '</p>';
                        echo "<p>Node - " . $row->location . "</p>";
                        echo '<p>' . $row->ssid . '</p>';
                        echo '</p>';
                        echo '</li>';
                    }

                    if (!in_array($row->nodeip_add, $chk)) {
                        if ($row->sub_category_id != NULL && $row->node_to_date == NULL) {
                            echo '<li>';
                            echo '<p>';
                            echo '<h2><a href="' . base_url() . 'index.php/ipblock_controller/assigned_ipblocks/1/' . $row->location_id . '">' . $row->location . '</a></h2>';
                            echo '<p>' . str_ireplace($search, '<span class = "highlight">' . $search . '</span>', $row->nodeip_add) . ' /' . $row->subnet . '</p>';
                            echo 'Node IP';
                            echo '</p>';
                            echo '</li>';
                            $chk[] = $row->nodeip_add;
                        }
                    }
                }

                foreach ($result1 as $row) {
                    if ($row->customer_id != NULL && $row->status == 1 && $row->cust_status != 1) {
                        echo '<li>';
                        echo '<p>';
                        if ($row->cust_status == NULL && $row->cust_to_date == NULL) {
                            echo '<h2><a href="' . base_url() . 'index.php/customer_controller/viewCustomer/' . $row->customer_id . '">' . $row->customer_name . '</a></h2>';
                        } else if ($row->cust_to_date != NULL && $row->cust_status == NULL) {
                            echo '<h2><a href="' . base_url() . 'index.php/customer_controller/viewTempCustomer/' . $row->customer_id . '">' . $row->customer_name . '</a></h2>';
                        }
                        echo '<p>' . str_ireplace($search, '<span class = "highlight">' . $search . '</span>', $row->ip_addresses) . ' /' . $row->subnet . '</p>';
                        echo $row->category_name . ' - ' . $row->ssid;
                        echo '</p>';
                        echo '</li>';
                    } else if ($row->status == 0 && $row->to_date == NULL) {
                        echo '<li>';
                        echo '<p>';
                        echo '<h2><a href="' . base_url() . 'index.php/ipblock_controller/assigned_ipblocks/' . $row->category_id . '/' . $row->sub_category_id . '">' . $row->ssid . '</a></h2>';
                        echo '<p>' . str_ireplace($search, '<span class = "highlight">' . $search . '</span>', $row->ip_addresses) . ' /' . $row->subnet . '</p>';
                        echo $row->category_name . ' - ' . $row->ssid;
                        echo '</p>';
                        echo '</li>';
                    }
                }
                echo '</ul>';
                echo '</div>';
            }
        }
        else
            $this->load->view('login/login');
    }

}