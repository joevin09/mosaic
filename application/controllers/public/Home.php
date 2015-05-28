<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends Public_Controller {

    public $per_page = 4;

    public function index() {
        $this->page();
    }

    public function page($page = 1) {
        $this->per_page = 4;
        $this->load->model('users_model');
        $offset = ($page - 1) * $this->per_page;
        // Last registered users
        $p = array(
            'where' => array(
                'agency_name IS NULL' => NULL,
            ),
            'order_by' => 'created DESC',
            'limit' => $this->per_page,
            'offset' => $offset
        );
        $data['count'] = $this->users_model->count($p);
        $data['last_registered'] = $this->users_model->get($p);
        // Last registered agencies
        $p = array(
            'where' => array(
                'agency_name IS NOT NULL' => NULL,
            ),
            'order_by' => 'created DESC',
            'limit' => $this->per_page,
            'offset' => $offset
        );
        $data['count_agencies'] = $this->users_model->count($p);
        $data['last_registered_agencies'] = $this->users_model->get($p);
        // Start pagination
        $this->load->library('pagination');
        $config['total_rows'] = $data['count'];
        $config['per_page'] = $this->per_page;
        $this->pagination->initialize($config);

        /* OUTPUT */
        $this->smarty->view(strtolower(basename(__FILE__, '.php')) . '.tpl', $data);
    }

}
