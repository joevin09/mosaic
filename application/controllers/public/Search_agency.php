<?php

class Search_agency extends Public_Controller {

    private $data = array();
    private $search = array();

    public function __construct() {
        parent::__construct();
        $this->load->model('agencies_model');
        $this->load->model('functions_model');
        $this->load->model('cities_model');
        $this->per_page = 16;
    }

    public function index() {
        $this->load->library('search_agencies');
    }

}
