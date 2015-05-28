<?php

class Logout extends Public_Controller {

    public function index() {
        $this->session->set_userdata('user_id', 0);
        redirect('login');
        exit;
    }

}
