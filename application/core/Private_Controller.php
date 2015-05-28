<?php

class Private_Controller extends Public_Controller {

    public function __construct() {
        parent::__construct();

        if (!$this->is_user_logged_in) {
            redirect('login');
            exit;
        }
    }

}
