<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Forgot_password extends Public_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model('users_model');
    }

    public function index() {
        $data['form'] = array(
            'birthday' => $this->birthday_start_year
        );
        if ($this->input->post('action') == "submit") {
            $this->_manage_register_form();
            $data['form'] = $this->input->post();
        }
        $data['start_year'] = date('Y', strtotime($this->birthday_start_year));
        /* OUTPUT */
        $this->smarty->view(strtolower(basename(__FILE__, '.php')) . '.tpl', $data);
    }

    private function _manage_register_form() {
        $this->_rules();
        if ($this->form_validation->run()) {
            $user = $this->users_model->get_user_by_email($this->input->post('email'));
            $tmp_passwd = random_string('alnum', 4);
            $update_data = array(
                'user_id' => $user->user_id,
                'change_passwd_code' => sha1($tmp_passwd),
                'change_passwd_date' => date('Y-m-d H:i:s'),
            );
            if ($this->users_model->insert_update($update_data)) {
                $this->_send_email($user->email, $tmp_passwd);
            }
        }
    }

    private function _send_email($email, $tmp_passwd) {
        $this->load->library('email');
        
//        print_r('EMAIL' . $email);
//        die();
        $this->email->from('your@example.com', 'Your Name');
        $this->email->to('joevinlicot@gmail.com');

        $this->email->subject("Récupération de votre mot de passe");
        $change_pwd_url = site_url('login').'?d='.encrypt(array('email' => $email));
        $this->email->message('Boujour ! Pour modifier votre mot de passe, cliquez sur le lien suivant ' . $change_pwd_url . ' et entrez le code ci-dessous : ' . $tmp_passwd);

        $this->email->send();
    }

    private function _rules() {
        $config = array(
            array(
                'field' => 'email-forgot',
                'rules' => 'required|valid_email|callback_check_email_exists|xss_clean',
            ),
        );
        $this->form_validation->set_rules($config);
    }

    public function check_email_exists($email) {
        $ret = FALSE;
        $user = $this->users_model->get_user_by_email($email);
        if (empty($user)) {
            $this->form_validation->set_message(__FUNCTION__, "Cette adresse email n'existe pas en base de données.");
        } else {
            $ret = TRUE;
        }
        return $ret;
    }

}
