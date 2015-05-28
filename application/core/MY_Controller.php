<?php

class MY_Controller extends CI_Controller {

    public $per_page;
    public $is_user_logged_in = FALSE;
    public $birthday_start_year;
    public $upload_folder;
    public $primary_nav;

    public function __construct() {
        parent::__construct();
        $this->_set_custom_config();
        if (config_item('gettext_enable')) {
            $this->load->library('Gettext');
        }
        $this->primary_nav();
        $this->check_user_logged_in();
        echo '<pre>' . print_r($this->user, true) . '</pre>';
        // More config
        date_default_timezone_set('Europe/Brussels');
        setlocale(LC_ALL, 'fr_FR.utf-8');
        $this->per_page = ($this->input->get('per_page')) ? $this->input->get('per_page') : 20;
        $this->upload_folder = 'uploads/' . date('Y') . '/' . date('m') . '/';
        $this->birthday_start_year = date('Y-m-d', strtotime('now -16 year'));
    }

    private function check_user_logged_in() {
        if ($this->session->userdata('user_id') > 0) {
            $this->load->model('users_model');
            $this->user = $this->users_model->get_row($this->session->userdata('user_id'));
            if (!empty($this->user)) {
                $this->is_user_logged_in = TRUE;
            }
        }
    }

    private function _set_custom_config() {
        $this->load->model('Options_model');
        $options = $this->Options_model->get_options();
        foreach ($options AS $v) {
            $this->config->set_item($v->name, $v->value);
        }
        // Load Swiftmailer
        $this->load->library('swiftmailer');
        if ($_SERVER['HTTPS']) {
            define('PROTOCOL', 'https');
            $this->config->set_item('base_url', str_replace('http://', 'https://', config_item('base_url')));
        }
    }

    public function primary_nav() {
        $this->primary_nav = array(
            array(
                'slug' => 'home',
                'name' => 'Accueil',
            ),
            array(
                'slug' => 'mosaic',
                'name' => 'Mosaic',
                'user_must_be_logged_in' => array(
                    'slug' => 'search',
                    'name' => 'Recherche',
                ),
            ),
            array(
                'slug' => 'contact',
                'name' => 'Contact',
            ),
        );
    }

    public function recaptcha($response) {
        $ret = FALSE;
        if (empty($response)) {
            $this->form_validation->set_message(__FUNCTION__, 'Veuillez compléter le CAPTCHA');
        } else {
            //set POST variables
            $url = 'https://www.google.com/recaptcha/api/siteverify';
            $fields = array(
                'secret' => RECAPTCHA_SECRET,
                'response' => $response,
                'remoteip' => $_SERVER['REMOTE_ADDR'],
            );

            //url-ify the data for the POST
            foreach ($fields as $key => $value) {
                $fields_string .= $key . '=' . $value . '&';
            }
            rtrim($fields_string, '&');

            //open connection
            $ch = curl_init();

            //set the url, number of POST vars, POST data
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POST, count($fields));
            curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

            //execute post
            $result = curl_exec($ch);
            $result = (array) json_decode($result);
            if (!$result['success']) {
                $this->form_validation->set_message(__FUNCTION__, 'Erreur CAPTCHA : ' . implode(', ', $result['error-codes']));
            } else {
                $ret = TRUE;
            }

            //close connection
            curl_close($ch);
        }
        return $ret;
    }

}

?>
