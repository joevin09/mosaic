<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Contact extends Public_Controller {

    public function index() {
        if ($this->input->post('action') == "submit") {
            $this->_send_form();
            $data['form'] = $this->input->post();
        }
        /* OUTPUT */
        $this->smarty->view(strtolower(basename(__FILE__, '.php')) . '.tpl', $data);
    }

    private function _send_form() {
        $this->_rules();
        if ($this->form_validation->run()) {
            $headers = 'From:' . ' ' . $this->input->post('last_name'). ' ' . $this->input->post('first_name');
            $message = array(
                'Email reçu de ' . $this->input->post('last_name'). ' ' . $this->input->post('first_name'),
                '',
                'Email : ' . $this->input->post('email'),
                '',
                'Message :' . ' ' . $this->input->post('message'),
            );
            if (mail('joevin.licot@gmail.com', "Demande d'information", implode(PHP_EOL, $message),$headers)) {
                $this->session->set_flashdata('msg_type', 'success');
                $this->session->set_flashdata('msg', "Un email envoyé");
                redirect(site_url('contact'));
                exit;
            }
        }
    }

    private function _rules() {
        $config = array(
            array(
                'field' => 'last_name',
                'rules' => 'required|xss_clean',
            ),
            array(
                'field' => 'first_name',
                'rules' => 'required|xss_clean',
            ),
            array(
                'field' => 'email',
                'rules' => 'required|valid_email|xss_clean',
            ),
//            array(
//                'field' => 'about',
//                'rules' => 'required|xss_clean',
//            ),
            array(
                'field' => 'message',
                'rules' => 'required|xss_clean',
            ),
        );
        $this->form_validation->set_rules($config);
    }

}
