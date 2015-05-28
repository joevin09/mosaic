<?php

class Members extends Public_Controller {

    public $users_model;

    public function __construct() {
        parent::__construct();
        require_once(BASEPATH . 'models/Users_model.php');
        $this->users_model = new Users_model();
    }

    public function index() {
        $data['users'] = $this->users_model->get_all_users();
        $this->smarty->view(basename(__FILE__, '.php') . '.tpl', $data);
    }

    public function view() {
        $user_id = $_GET['var1'];
        $data['user'] = $this->users_model->get_user_by_id($user_id);
        $this->smarty->view(basename(__FILE__, '.php') . '_' . __FUNCTION__ . '.tpl', $data);
    }

}
