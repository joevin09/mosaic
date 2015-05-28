<?php

class Login extends Public_Controller {

    public function index() {
        if ($this->input->post('action') == "submit") {
            $this->_manage_register_form();
        }
        /* OUTPUT */
        $this->smarty->view(strtolower(basename(__FILE__, '.php')) . '.tpl', $data);
    }

    public function change_password() {
        $d = $this->input->get('d');
        $d = decrypt($d);
        echo '<pre>' . print_r($d, true) . '</pre>';
        $data['form'] = $d;
        /* OUTPUT */
        $this->smarty->view($this->router->fetch_class() . '_' . $this->router->fetch_method() . '.tpl', $data);
    }

    private function _manage_register_form() {
        $this->_rules();
        if ($this->form_validation->run()) {
           
            if($this->user->agency_name == NULL){
                redirect(site_url('mosaic'));
            } else {
                redirect(site_url('mosaic_agency'));
            }
            
           exit;
      
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

}
