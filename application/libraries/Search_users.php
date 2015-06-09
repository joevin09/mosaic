<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Search_users {

    private $data = array();
    private $search = array();
    private $CI;

    public function __construct($config = "") {
        $this->CI = & get_instance();
        $this->CI->load->model('users_model');
        $this->CI->load->model('functions_model');
//        $this->CI->load->model('cities_model');
        $this->CI->load->model('professions_status_model');
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
        //echo '<pre>$this->search: ' . print_r($this->search, true) . '</pre>';
        // Save last search query url
        if ($this->CI->router->fetch_class() === "search") {
            $last_search_query = preg_replace('#^' . $this->CI->router->fetch_class() . '/#i', '', $this->CI->uri->uri_string());
            $this->CI->session->set_userdata("search_query", $last_search_query);
            if ($this->CI->user->user_id) {
                $update_data = array(
                    'user_id' => $this->CI->user->user_id,
                    'last_search_uri' => $last_search_query,
                );
                $this->CI->users_model->insert_update($update_data);
            }
        }
        // Query the different steps
        $step_counter = 0;
        if (empty($this->search)) { //
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
        $this->data['list'] = $this->CI->users_model->search($this->search);
        if (empty($this->data['list'])) {
            $p = array(
                'orderby' => 'created DESC',
                'limit' => $this->CI->per_page,
            );
            $this->data['members'] = $this->CI->users_model->get($p);
        }
        // Default breadcrumb
        $this->data['breadcrumb'] = array(
            array(
                'slug' => 'function',
                'name' => '1 | Fonction',
            ),
            array(
                'slug' => 'experience',
                'name' => '2 | Expérience',
            ),
//            array(
//                'slug' => 'city',
//                'name' => '3 | Région',
//            ),
            array(
                'slug' => 'profession_status',
                'name' => '3 | Statut',
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
//        echo '<pre>call : ' . print_r(__FUNCTION__, true) . '</pre>';
        $this->CI->load->model('functions_model');
        $this->data['select_list'] = $this->CI->functions_model->get(array('orderby' => 'menu_order ASC'));
        foreach ($this->data['select_list'] AS &$v) {
//            $v->url_value = site_url(array($this->CI->router->fetch_class(), 'function', $v->function_slug));
            $v->url_value = $this->_create_url('function', $v->function_slug);
        }
        $this->data['current_breadcrumb'] = 'function';
        $this->data['select_title'] = "Fonctions";
        $this->data['select_page_title'] = "Fonctions";
        $this->data['select_head_title'] = "Fonctions";
        $this->data['select_h3'] = "Quelle fonction cherches-tu ?";
        $this->data['select_p'] = "Partage-nous cette fonction afin de faire la meilleure recherche.";
        $this->data['field_name_value'] = "function_name";
    }

    private function _function() {
//        echo '<pre>call : ' . print_r(__FUNCTION__, true) . '</pre>';
        $this->CI->load->model('experiences_model');
        $this->data['select_list'] = $this->CI->experiences_model->get(array('orderby' => 'menu_order ASC'));
        foreach ($this->data['select_list'] AS &$v) {
            //$v->url_value = site_url(array($this->CI->router->fetch_class(), 'function', $this->search['function'], 'experience', $v->experience_slug));
            $v->url_value = $this->_create_url('experience', $v->experience_slug);
        }
        $this->data['current_breadcrumb'] = 'experience';
        $this->data['select_title'] = "Expériences";
        $this->data['select_page_title'] = "Expériences";
        $this->data['select_head_title'] = "Expériences";
        $this->data['select_h3'] = "Quelle est l'expérience nécessaire ?";
        $this->data['select_p'] = "Donne nous l'expérience minimum à avoir pour convenir à ta recherche :";
        $this->data['field_name_value'] = "experience_name";
    }

//    private function _experience() {
////        echo '<pre>call : ' . print_r(__FUNCTION__, true) . '</pre>';
//        $this->CI->load->model('cities_model');
//        $this->data['select_list'] = $this->CI->cities_model->get(array('orderby' => 'menu_order ASC'));
//        foreach ($this->data['select_list'] AS &$v) {
//            $v->url_value = $this->_create_url('city', $v->city_slug);
//        }
//        $this->data['current_breadcrumb'] = 'city';
//        $this->data['select_title'] = "Régions";
//        $this->data['select_page_title'] = "Régions";
//        $this->data['select_head_title'] = "Régions";
//        $this->data['select_h3'] = "Dans quel région cherches-tu ?";
//        $this->data['select_p'] = "Soumets-nous ta localité afin que l’on puisse faire une sélection plus avancée :";
//        $this->data['field_name_value'] = "city_name";
//    }
//
    private function _experience() {
//        echo '<pre>call : ' . print_r(__FUNCTION__, true) . '</pre>';
        $this->CI->load->model('professions_status_model');
        $this->data['select_list'] = $this->CI->professions_status_model->get(array('orderby' => 'menu_order ASC'));
        foreach ($this->data['select_list'] AS &$v) {
            $v->url_value = $this->_create_url('profession_status', $v->profession_slug);
        }
        $this->data['current_breadcrumb'] = 'profession_status';
        $this->data['select_title'] = "Statuts";
        $this->data['select_page_title'] = "Statuts";
        $this->data['select_head_title'] = "Statuts";
        $this->data['select_h3'] = "Quel statut professionnel désires-tu ?";
        $this->data['select_p'] = "Tu cherches un postulant avec un statut particulier pour ton entreprise :";
        $this->data['field_name_value'] = "profession_name";
    }

    private function _profession_status() {
        $this->data['list'] = $this->CI->users_model->search($this->search);
        if (empty($this->data['list'])) {
            $p = array(
                'orderby' => 'created DESC',
                'limit' => $this->CI->per_page,
            );
            $this->data['members'] = $this->CI->users_model->get($p);
        }
//        echo '<pre>' . print_r($this->data['list'], true) . '</pre>';
//        die();
//      Display class.tpl
        if ($this->CI->router->fetch_class() !== "mosaic") {
            $this->CI->smarty->view('search_finish.tpl', $this->data);
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
