<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends Public_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $data['form'] = array(
            'birthday' => $this->birthday_start_year
        );
        if ($this->input->post('action')) {
            $this->_manage_register_form();
            $data['form'] = $this->input->post();
        }
        /* OUTPUT */
        $this->smarty->view(strtolower(basename(__FILE__, '.php')) . '.tpl', $data);
    }

    private function _manage_register_form() {
        if ($this->input->post('action') === "submit_agency") {
            $this->_manage_register_agency();
        } else {
            $this->_manage_register_postulant();
        }
    }
    
    private function _manage_register_postulant() {
        $this->_rules();
        if ($this->form_validation->run()) {
            // Insert in database HERE !
            $insert_data = $this->input->post();
            $insert_data['last_search_uri'] = $this->session->userdata('search_query');
            $this->load->model('users_model');
            if ($user_id = $this->users_model->insert_update($insert_data)) {
                // Send confirmation email
                $headers = 'From: Mosaic' . "\r\n" . 'Reply-To: mosaic@m-saic.be';
                $message = array(
                    'Bonjour' . ' '. $this->input->post('first_name') . ' ' . $this->input->post('last_name') . ',',
                    '',
                    'Tu es bien inscrit sur le site mosaic.',
                    '',
                    'Connecte-toi : http://m-saic.be/login/',
                    '',
                    'Bien à toi,',
                    '',
                    "L'équipe Mosaic"
                );
                mail($this->input->post('email'), 'Inscription réussite', implode(PHP_EOL, $message),$headers);
                // Prepare redirect
                $this->session->set_userdata('user_id', $user_id);
                redirect(site_url());
                exit;
            }
        }
    }
    
    private function _manage_register_agency() {
        $this->_rules_agency();
        if ($this->form_validation->run()) {
            // Insert in database HERE !
            $insert_data = $this->input->post();
            $insert_data['last_search_uri'] = $this->session->userdata('search_query');
            $insert_data = array(
                'agency_name' => $this->input->post('agency_name'),
                'passwd' => $this->input->post('agency_passwd'),
                'email' => $this->input->post('agency_email'),
                'last_search_uri' => $this->session->userdata('search_query'),
            );
            $this->load->model('users_model');
            if ($user_id = $this->users_model->insert_update($insert_data)) {
                // Send confirmation email
                $message = array(
                    'Bonjour,',
                    '',
                    'Vous étes bien inscrit sur le site mosaic.'
                );
                mail($this->input->post('email'), 'Inscription réussite', implode(PHP_EOL, $message));
                // Prepare redirect
                $this->session->set_userdata('user_id', $user_id);
                redirect(site_url("profil"));
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
                'rules' => 'required|valid_email|is_unique[users.email]|xss_clean',
            ),
            array(
                'field' => 'passwd', //md5 ?
                'rules' => 'required|min_length[6]|xss_clean',
            ),
//            array(
//                'field' => 'Date_Day',
//                'rules' => 'required|xss_clean',
//            ),
//            array(
//                'field' => 'Date_Month',
//                'rules' => 'required|xss_clean',
//            ),
//            array(
//                'field' => 'Date_Year',
//                'rules' => 'required|callback_check_birthdate|xss_clean',
//            ),
//            array(
//                'field' => 'sexe',
//                'rules' => 'required|is_natural_no_zero|xss_clean',
//            ),
//            array(
//                'field' => 'nbr_agency',
//                'rules' => 'required|xss_clean',
//            ),
//
//            array(
//                'field' => 'g-recaptcha-response',
//                'rules' => 'callback_recaptcha',
//            ),
        );
        $this->form_validation->set_rules($config);
    }
    
    private function _rules_agency() {
        $config = array(
            array(
                'field' => 'agency_name',
                'rules' => 'required|xss_clean',
            ),
            array(
                'field' => 'agency_email',
                'rules' => 'required|valid_email|is_unique[users.email]|xss_clean',
            ),
            array(
                'field' => 'agency_passwd', //md5 ?
                'rules' => 'required|min_length[6]|xss_clean',
            ),
        );
        $this->form_validation->set_rules($config);
    }

    public function check_birthdate() {
        $ret = TRUE;
        $_POST['birthday'] = $this->input->post('Date_Year') . '-' . $this->input->post('Date_Month') . '-' . $this->input->post('Date_Day');
        if ($_POST['birthday'] > $this->birthday_start_year) {
            $ret = FALSE;
            $this->form_validation->set_message(__FUNCTION__, 'Date de naissance non valide.');
        }
        return $ret;
    }

}
