<?php

class Public_Controller extends MY_Controller {

    public function __construct() {
        parent::__construct();

        $this->_check_for_maintenance();
    }

    private function _check_for_maintenance() {
        // Check if site is under maintenance
        if ($this->router->fetch_class() != 'login' && $this->router->fetch_class() != 'maintenance') {
            if (config_item('site_in_maintenance') && !$this->session->userdata('id_admin')) {
                redirect(base_url('maintenance', FALSE) . '?redirect=' . base64_encode(current_url()), 'refresh', 503);
                exit;
            }
        }
    }

}

?>
