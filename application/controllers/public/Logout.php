<?php

class Logout extends Public_Controller {

    public function index() {
        $this->session->set_userdata('user_id', 0);
        $this->session->set_userdata('search_query', '');
        redirect('login');
        exit;
    }

}
