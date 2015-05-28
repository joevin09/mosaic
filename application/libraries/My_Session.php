<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class MY_Session extends CI_Session {

    /**
     * Update an existing session
     *
     * @access    public
     * @return    void
     */
    function sess_update() {
        // skip the session update if this is an AJAX call!
        if (!IS_AJAX) {
            parent::sess_update();
        }
    }
    
    function _set_cookie($cookie_data = NULL) {
        if (is_null($cookie_data)) {
            $cookie_data = $this->userdata;
        }

        // Serialize the userdata for the cookie
        $cookie_data = $this->_serialize($cookie_data);

        if ($this->sess_encrypt_cookie == TRUE) {
            $cookie_data = $this->CI->encrypt->encode($cookie_data);
        } else {
            // if encryption is not used, we provide an md5 hash to prevent userside tampering
            $cookie_data = $cookie_data . md5($cookie_data . $this->encryption_key);
        }

        setcookie(
                $this->sess_cookie_name, $cookie_data, $this->userdata('remember_me') == true ? $this->sess_expiration + time() : 0, $this->cookie_path, $this->cookie_domain, 0
        );
    }

}
