<?php

class Home extends Public_Controller {

    public function index() {
        $this->smarty->view(basename(__FILE__, '.php') . '.tpl');
    }

}
