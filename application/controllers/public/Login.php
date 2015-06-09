<?php

class Login extends Public_Controller {

    public function index() {
        if ($this->input->post('action') == "submit") {
            $this->_manage_register_form();
            $data['form'] = $_POST;
        } else if($this->input->post('action') == "forgot"){
            $data['form'] = $_POST;
            $this->_manage_forgot_form();
        }
        /* OUTPUT */
        $this->smarty->view(strtolower(basename(__FILE__, '.php')) . '.tpl', $data);
    }

    public function change_password() {
        $d = $this->input->get('d');
        $d = decrypt($d);
//        echo '<pre>' . print_r($d, true) . '</pre>';
        $data['form'] = $d;
        /* OUTPUT */
        $this->smarty->view($this->router->fetch_class() . '_' . $this->router->fetch_method() . '.tpl', $data);
    }

    private function _manage_register_form() {
        $this->_rules();
        if ($this->form_validation->run()) {
            redirect(site_url('mosaic'));
            exit;
        }
    }
    
    private function _manage_forgot_form() {
        
        $this->load->model('users_model');
        $this->_rules_forgot();

        if ($this->form_validation->run()) {
            
            $user = $this->users_model->get_user_by_email($this->input->post('email-forgot'));
            $tmp_passwd = random_string('alnum', 6);
            $update_data = array(
                'user_id' => $user->user_id,
                'passwd' => sha1($tmp_passwd),
                'change_passwd_date' => date('Y-m-d H:i:s'),
            );
            
            if ($this->users_model->insert_update($update_data)) {
                $this->_send_email($user->email, $tmp_passwd);
            }
        }
    }

    private function _rules() {
        $config = array(
            array(
                'field' => 'email',
                'rules' => 'required|valid_email|xss_clean',
            ),
            array(
                'field' => 'passwd',
                'rules' => 'required|min_length[6]|callback_check_email_passwd_pair|xss_clean',
            ),
            
        );
        $this->form_validation->set_rules($config);
    }

    public function check_email_passwd_pair() {
        $ret = FALSE;
        $this->load->model('users_model');
        $user_id = $this->users_model->check_login_passwd($this->input->post('email'), $this->input->post('passwd'));
        if ($user_id > 0) {
            $ret = TRUE;
            $this->session->set_userdata('user_id', $user_id);
        } else {
            $this->form_validation->set_message(__FUNCTION__, 'Email ou mot de passe invalide.');
        }
        return $ret;
    }
    
    private function _send_email($email, $tmp_passwd) {
        
//        print_r($email);
        
        $this->load->library('email');
        $this->email->from('mosaic@m-saic.be', 'Mosaic');
        $this->email->to($email);

        $this->email->subject("Récupération de votre mot de passe");
        $change_pwd_url = site_url('login').'?e='. base64_encode($email);
        $this->email->message('Boujour ! Pour vous reconnectez, cliquez sur le lien suivant ' . $change_pwd_url . ' et entrez le code ci-dessous : ' . $tmp_passwd);

        $this->email->send();
    }
    
    private function _rules_forgot() {
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
        $this->load->model('users_model');
        $user = $this->users_model->get_user_by_email($email);
        if (empty($user)) {
            $this->form_validation->set_message(__FUNCTION__, "Cette adresse email n'existe pas en base de données.");
        } else {
            $ret = TRUE;
        }
        return $ret;
    }

}
