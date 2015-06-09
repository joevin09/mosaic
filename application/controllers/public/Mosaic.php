<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Mosaic extends Public_Controller {

    public function index() {
        /* OUTPUT */
        $search_query_uri = $this->session->userdata('search_query');
        if ($this->user->user_id > 0) {
            $search_query_uri = $this->user->last_search_uri;
        }
        $search_lib = ($this->user->agency_name) ? 'search_users' : 'search_agencies';
        $this->load->library($search_lib, array('search' => $search_query_uri));
    }

}
