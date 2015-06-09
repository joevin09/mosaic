<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');


//$url = $_SERVER[REQUEST_URI];
//$url = explode('/', $url);
//$flag = 0;
//
//print_r($url);
//
//foreach($url as $k){
//    print_r($k . " ");
//    
//    if($flag == 2 && $k != ""){
//        if($k != "function"){
//            die();
//        }
//    } else if($flag == 3 && $k != ""){
//        
//        if($k != "design-web" || $k != "developpement-web" || $k != "seo-sem" || $k != "gestion-de-projets" || $k != "marketing" || $k != "reseau" || $k != "autres"){
//            die();
//        }
//        
//    } else if($flag == 4 && $k != ""){
//        if($k != "city"){
//            die();
//        }
//        
//    } else if($flag == 5 && $k != ""){
//        if($k != "nbr_member"){
//             die();
//        }
//    }
//    
//    print_r($flag);
//    
//    $flag++;
//}

class Search_agencies {

    private $data = array();
    private $search = array();
    private $CI;

    public function __construct($config = "") {
        $this->CI = & get_instance();
        $this->CI->load->model('agencies_model');
        $this->CI->load->model('functions_model');
        $this->CI->load->model('cities_model');
        $this->index($config);
    }

    public function index($config = "") {
        // Get search query
        $this->search = $this->CI->uri->ruri_to_assoc();
        // Overwrite search query from $config
        if (isset($config['search']) && !empty($config['search'])) {
            if (!is_array($config['search'])) {
                $config['search'] = $this->_uri_string_to_assoc($config['search']);
            }
            $this->search = array_merge($this->search, $config['search']);
        }
        // Save last search query url
        if ($this->CI->router->fetch_class() === "search_agency") {
            $last_search_query = preg_replace('#^' . $this->CI->router->fetch_class() . '/#i', '', $this->CI->uri->uri_string());
            $this->CI->session->set_userdata("search_query", $last_search_query);
            if ($this->CI->user->user_id) {
                $update_data = array(
                    'user_id' => $this->CI->user->user_id,
                    'last_search_uri' => $last_search_query,
                );
                $this->CI->agencies_model->insert_update($update_data);
//                echo '<pre>$this->search: ' . print_r($update_data) . '</pre>';
//                die;
            }
        }
        // Query the different steps
        $step_counter = 0;
        if (empty($this->search)) {
            // Aucun élément dans l'URL donc pas encore de recherche
            $this->_search();
        }
        foreach ($this->search AS $field => $value) {

            if ($field !== $this->CI->router->fetch_class()) {
                $this->data["search_" . $field] = $value;
            }
            if ($step_counter == (count($this->search) - 1)) {
                // Dès qu'on a une recherche, on prend le dernier $field - l'avant dernier $field est à l'offest -2 car on commence à 0 et non à 1
                $method_name = "_" . $field;
                if (method_exists($this, $method_name)) {
                    $this->{$method_name}();
                }
            }
            $step_counter++;
        }
        $this->data['list'] = $this->CI->agencies_model->search($this->search);
        if (empty($this->data['list'])) {
            $p = array(
                'orderby' => 'created DESC',
                'limit' => $this->CI->per_page,
            );
            $this->data['members'] = $this->CI->agencies_model->get($p);
        }
        // Default breadcrumb
        $this->data['breadcrumb'] = array(
            array(
                'slug' => 'function',
                'name' => '1 | Secteur',
            ),
            array(
                'slug' => 'city',
                'name' => '2 | Région',
            ),
            array(
                'slug' => 'nbr_member',
                'name' => '3 | Nombre de membre',
            ),
        );

        if (!empty($this->search)) {
            foreach ($this->data['breadcrumb'] AS $k => &$v) {
                //var_dump($v);
                $previous_link = $v['url'] = "";
                if (isset($this->data['breadcrumb'][$k - 1])) {
                    $slug = $this->data['breadcrumb'][$k - 1]['slug'];
                    $value = $this->search[$slug];
                    $previous_link = $this->data['breadcrumb'][$k - 1]['url'];
                    $v['url'] = $previous_link . $slug . '/' . $value . '/';
                    $str = str_replace('-', ' ', $value);
                    $this->data['breadcrumb'][$k - 1]['name'] = $k . ' | ' . UcFirstAndToLower($str);
                }
                if ($v['slug'] === $this->data['current_breadcrumb']) {
                    break;
                }
                $v['active'] = TRUE;
            }
            unset($v);
        }
        // Display class.tpl
        $this->CI->smarty->view(strtolower($this->CI->router->fetch_class()) . '.tpl', $this->data);
    }

    private function _search() {
        $this->CI->load->model('functions_model');
        $this->data['select_list'] = $this->CI->functions_model->get(array('orderby' => 'menu_order ASC'));
        foreach ($this->data['select_list'] AS &$v) {
            $v->url_value = $this->_create_url('function', $v->function_slug);
        }
        $this->data['current_breadcrumb'] = 'function';
        $this->data['select_title'] = "Secteurs";
        $this->data['select_page_title'] = "Secteurs";
        $this->data['select_head_title'] = "Secteurs";
        $this->data['select_h3'] = "Dans quel secteur cherches-tu ?";
        $this->data['select_p'] = "Partage nous ce secteur afin de faire la meilleure recherche.";
        $this->data['field_name_value'] = "function_name";
    }

    private function _function() {
        $this->CI->load->model('cities_model');
        $this->data['select_list'] = $this->CI->cities_model->get(array('orderby' => 'menu_order ASC'));
        foreach ($this->data['select_list'] AS &$v) {
            $v->url_value = $this->_create_url('city', $v->city_slug);
        }
        $this->data['current_breadcrumb'] = 'city';
        $this->data['select_title'] = "Régions";
        $this->data['select_page_title'] = "Régions";
        $this->data['select_head_title'] = "Régions";
        $this->data['select_h3'] = "Dans quel région cherches-tu ?";
        $this->data['select_p'] = "Soumets-nous ta localité afin que l’on puisse faire une sélection plus avancée :";
        $this->data['field_name_value'] = "city_name";
    }

    private function _city() {
        $select_list = array(
            '1-10' => '< 10',
            '11-20' => '11-20',
            '21-100' => '> 21',
        );
        foreach ($select_list AS $k => $v) {
            $obj = new stdClass();
            $obj->nbr_member = $k;
            $obj->nbr_member_name = $v;
            $obj->url_value = $this->_create_url('nbr_member', $obj->nbr_member);
            $this->data['select_list'][] = $obj;
        }
        $this->data['current_breadcrumb'] = 'nbr_member';
        $this->data['select_title'] = "Nombre de membre";
        $this->data['select_page_title'] = "Nombre de membre";
        $this->data['select_head_title'] = "Nombre de membre";
        $this->data['select_h3'] = "Quel est la grandeur de l'agence ?";
        $this->data['select_p'] = "Tu cherches une agence composée de combien de personne :";
        $this->data['field_name_value'] = "nbr_member_name";
    }

    private function _nbr_member() {
        $this->data['list'] = $this->CI->agencies_model->search($this->search);
        if (empty($this->data['list'])) {
            $p = array(
                'orderby' => 'created DESC',
                'limit' => $this->CI->per_page,
            );
            $this->data['members'] = $this->CI->agencies_model->get($p);
        }
        //      Display class.tpl
        if ($this->CI->router->fetch_class() !== "mosaic") {
            $this->CI->smarty->view('search_finish_agency.tpl', $this->data);
            exit;
        }
    }

    private function _create_url($new_key, $new_value) {
        $url = array($this->CI->router->fetch_class());
        foreach ($this->search AS $k => $v) {
            $url[] = $k;
            $url[] = $v;
        }
        $url[] = $new_key;
        $url[] = $new_value;
        return site_url($url);
    }

    private function _uri_string_to_assoc($str) {
        $ret = array();
        $arr = explode('/', $str);
        for ($i = 0; $i < count($arr); $i+=2) {
            $ret[$arr[$i]] = $arr[($i + 1)];
        }
        return $ret;
    }

}
