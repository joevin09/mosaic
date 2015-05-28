<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class privacy extends Public_Controller {

    public function index() {
        /* OUTPUT */
        $this->smarty->view(strtolower(basename(__FILE__, '.php')) . '.tpl', $data);
    }

}