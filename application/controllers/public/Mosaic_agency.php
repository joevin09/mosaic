<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Mosaic_agency extends Public_Controller {

    public function index() {
        /* OUTPUT */
        $search_query_uri = $this->session->userdata('search_query');
        if ($this->user->user_id > 0) {
            $search_query_uri = $this->user->last_search_uri;
        }
        $search_lib = 'search_agencies';
        $this->load->library($search_lib, array('search' => $search_query_uri));
    }

}
