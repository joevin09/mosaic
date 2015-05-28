<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class MY_Form_validation extends CI_Form_validation {

    protected $_config_rules = array();

    public function __construct() {
        parent::__construct();
    }

    // --------------------------------------------------------------------

    /**
     * Valid Date (ISO format)
     *
     * @access    public
     * @param    string
     * @return    bool
     */
    public function valid_date(&$str, $format = "yyyy-mm-dd") {
        $ret = FALSE;
        if ($format != "yyyy-mm-dd") {
            if ($format == "dd-mm-yyyy") {
                $str = preg_replace("#^(\d{2})(?:/|-)(\d{2})(?:/|-)(\d{4})#i", "$3-$2-$1", $str);
            }
        }
        if (preg_match("#([0-9]{4})-([0-9]{1,2})-([0-9]{1,2})#i", $str, $matches)) {
            $ret = checkdate($matches[2], $matches[3], $matches[1]);
        }
        if (!$ret) {
            $this->_error_messages['valid_date'] = "La date ou son format n'est pas valide.";
        }
        return $ret;
    }

    public function valid_multi_emails($str) {
        $emails = explode(',', $str);
        $invalid_emails = array();
        foreach ($emails AS $k => &$v) {
            $v = trim($v);
            if (!empty($v)) {
                if (!valid_email($v)) {
                    $invalid_emails[] = $v;
                }
            }
        }
        if (!empty($invalid_emails)) {
            if (count($invalid_emails) > 1) {
                $message = "L'adresse " . $invalid_emails[0] . " n'est pas valide";
            } else {
                $message = "Les adresses suivantes ne sont pas valides : " . implode(', ', $invalid_emails);
            }
            $this->_error_messages['valid_date'] = $message;
        }
        return (empty($invalid_emails));
    }

    /**
     * Valid Float (DB format : X.XX)
     *
     * @access    public
     * @param    string
     * @return    bool
     */
    public function prep_float(&$str, $decimals = 2) {
        $str = str_replace(',', '.', $str);
        $str = sprintf('%1.2f', $str);
        return str_replace(',', '.', $str);
    }

    public function required_image(&$str) {
        echo '<pre>$str: ' . print_r($str, true) . '</pre>';
        die();
        $ret = FALSE;
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'gif|jpg|png';
//            $config['max_size'] = '1000';
//            $config['max_width'] = '1024';
//            $config['max_height'] = '768';

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload($file, FALSE)) {
//            $this->form_validation->set_message('checkdoc', $data['error'] = $this->upload->display_errors());
            $this->_error_messages['valid_date'] = $this->upload->display_errors();

//            if ($_FILES['userfile']['error'] != 4) {
//                return false;
//            }
        } else {
            $ret = TRUE;
        }
        return $ret;
//        }
    }

    public function less_than_or_equal(&$str, $max) {
        $ret = FALSE;
        $str = number_format(str_replace(',', '.', $str), 2, '.', '');
        if (!is_numeric($str)) {
            return FALSE;
        }
        if ($str <= $max) {
            $ret = TRUE;
        }
        return $ret;
    }

}

?> 