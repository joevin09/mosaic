<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Maintenance extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('news_model');
    }

    public function index() {
        header('HTTP/1.1 503 Service Temporarily Unavailable');
        header('Status: 503 Service Temporarily Unavailable');
        ini_set('display_errors', 1);
        error_reporting(E_ALL);
        if (config_item('maintenance_back_time')) {
            header('Retry-After: ' . $this->_http_date(config_item('maintenance_back_time')));
        }
        header('X-Powered-By:');
        $_GET['canvas'] = "_popover";
        $this->smarty->view(strtolower(basename(__FILE__, '.php')) . '.tpl', $data);
    }

    private function _http_date($date) {
        return date('r', strtotime($date));
    }

}
