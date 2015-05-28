<?php

class Members extends Public_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('users_model');
        $this->load->model('functions_model');
        $this->per_page = 8;
    }

    public function index() {
        $data['list'] = $this->users_model->get();
        $data['functions_list'] = $this->functions_model->get(array('orderby' => 'menu_order ASC'));
        // Display class.tpl
        $this->smarty->view(strtolower($this->router->fetch_class()) . '.tpl', $data);
    }

    public function view($id = "") {
        if (empty($id)) {
            redirect($this->router->fetch_class());
            exit;
        }
        $data['member'] = $this->users_model->get_row($id);
        $this->_rules();
        
        if ($data['member']->user_id > 0 && $this->input->post('action') == "contacter" && $this->form_validation->run()) {
            $headers = 'From: Mosaic' . "\r\n" . 'Reply-To:' . $this->input->post('contact_email');
            $message = array(
                'Bonjour' . ' ' . $data['member']->first_name . ' ' . $data['member']->last_name . ',',
                '',
                'Tu as reçu un e-mail de : ' . $this->input->post('contact_email'),
                '',
                'Voiçi son message :' . ' ' . $this->input->post('contact_message'),
                '',
                "L'équipe Mosaic"
            );
            if (mail($data['member']->email, 'Contact depuis le site ' . config_item('site_name'), implode(PHP_EOL, $message), $headers)) {

                $this->session->set_flashdata('msg_type', 'success');
                $this->session->set_flashdata('msg', "Un email a été envoyé à " . $data['member']->first_name);
//                die('before redirect OK');
                redirect(current_url());
                exit;
            }
            //die('Envoyer l\'email de contact à ' . $data['member']->email . ' de la part de ' . $this->input->post('contact_email'));
        }
        // Display class.tpl
        $this->smarty->view(strtolower($this->router->fetch_class()) . '_' . $this->router->fetch_method() . '.tpl', $data);
    }

    public function search() {
        $search = $this->uri->uri_to_assoc();
        foreach ($search AS $field => $value) {
            if ($field !== $this->router->fetch_class()) {
                $data["search_" . $field] = $value;
                $this->session->set_userdata("search_" . $field, $value);
            }
        }
        $data['list'] = $this->users_model->search($search);
        if (empty($data['list'])) {
            $p = array(
                'orderby' => 'created DESC',
                'limit' => $this->per_page,
            );
            $data['members'] = $this->users_model->get($p);
        }
        // Display class.tpl
        $this->smarty->view(strtolower($this->router->fetch_class()) . '_' . $this->router->fetch_method() . '.tpl', $data);
    }

    private function _rules() {
        $config = array(
            array(
                'field' => 'contact_email',
                'rules' => 'required|valid_email|xss_clean',
            ),
//            array(
//                'field' => 'about',
//                'rules' => 'required|xss_clean',
//            ),
            array(
                'field' => 'contact_message',
                'rules' => 'required|xss_clean',
            ),
        );
        $this->form_validation->set_rules($config);
    }

}
