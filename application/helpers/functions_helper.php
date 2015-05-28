<?php

if (!function_exists('sort_languages')) {

    function sort_languages($a, $b) {
        return strcmp($a->iso, $b->iso);
    }

}
if (!function_exists('get_page_title')) {

    function get_page_title($page_id) {
        $ci = & get_instance();
        $page = $ci->pages_model->get_one($page_id);
        return $page->title;
    }

}

if (!function_exists('get_permalink')) {

    function get_permalink($id, $lang_id = "") {
        $ci = & get_instance();
        if (!is_object($ci->pages_model)) {
            $ci->load->model('pages_model');
        }
        return $ci->pages_model->get_permalink($id, $lang_id);
    }

}

if (!function_exists('get_enum_values')) {

    function get_enum_values($table, $field = "status") {
        $CI = & get_instance();
        $type = $CI->db->query("SHOW COLUMNS FROM " . $CI->db->dbprefix($table) . " WHERE Field = '{$field}'")->row(0)->Type;
        preg_match('/^enum\((.*)\)$/', $type, $matches);
        foreach (explode(',', $matches[1]) as $value) {
            $enum[] = trim($value, "'");
        }
        return $enum;
    }

}

if (!function_exists('get_thumb_path')) {

    function get_thumb_path($filename) {
        $filepath = FCPATH . $filename;
        $filename = basename($filepath);
        return str_replace(basename($filename), '', $filepath) . 'thumbs/' . $filename;
    }

}

if (!function_exists('get_thumb_url')) {

    function get_thumb_url($filename) {
        $filepath = $filename;
        $filename = basename($filepath);
        $url = str_replace(basename($filename), '', $filepath) . 'thumbs/' . $filename;
        return image_url($url);
    }

}

if (!function_exists('show_agenda_dates')) {

    function show_agenda_dates($item) {
        $str = "Du ";
        $time_from = strtotime($item['date_from']);
        $time_to = strtotime($item['date_to']);
        $strftime_from = '%e %B';
        if (date('m', $time_from) == date('m', $time_to) && date('Y', $time_from) == date('Y', $time_to)) {
            $strftime_from = '%e';
        } else if (date('m', $time_from) == date('m', $time_to)) {
            $strftime_from = '%e %B %Y';
        }
        return "Du " . strftime($strftime_from, $time_from) . " au " . strftime('%e %B %Y', $time_to);
    }

}
if (!function_exists('set_title')) {

    function set_title($name) {
        //return config_item('title_prefix') . " - " . config_item('site_name') . " - " . $name;
        return $name . " | " . config_item('site_name') . " - " . config_item('title_prefix');
    }

}

if (!function_exists('parse_signed_request')) {

    function parse_signed_request($signed_request = "") {
        if (empty($signed_request)) {
            $signed_request = $_REQUEST['signed_request'];
        }
        list($encoded_sig, $payload) = explode('.', $signed_request, 2);

        $secret = FB_APP_SECRET; // Use your app secret here
        // decode the data
        $sig = base64_url_decode($encoded_sig);
        $data = json_decode(base64_url_decode($payload), true);

        // confirm the signature
        $expected_sig = hash_hmac('sha256', $payload, $secret, $raw = true);
        if ($sig !== $expected_sig) {
            error_log('Bad Signed JSON signature!');
            return null;
        }

        return $data;
    }

}
if (!function_exists('base64_url_decode')) {

    function base64_url_decode($input) {
        return base64_decode(strtr($input, '-_', '+/'));
    }

}

if (!function_exists('getMaxFileSize')) {

    function getMaxFileSize() {
        $max_upload = (int) (ini_get('upload_max_filesize'));
        $max_post = (int) (ini_get('post_max_size'));
        $memory_limit = (int) (ini_get('memory_limit'));
        return min($max_upload, $max_post, $memory_limit);
    }

}

if (!function_exists('get_user_directory')) {

    function get_user_directory($user_id) {
        $user_id = sprintf('%06d', $user_id);
        return substr($user_id, 0, 2) . "/" . substr($user_id, 2, 2) . "/" . substr($user_id, 4, 2) . "/";
    }

}

if (!function_exists('getFirstPara')) {

    function getFirstPara($string) {
        $string = substr($string, 0, strpos($string, "</p>") + 4);
        return $string;
    }

}

if (!function_exists('setFlash')) {

    function setFlash($msg, $type = "danger") {
        $CI = & get_instance();
        $CI->session->set_flashdata("msg", $msg);
        $CI->session->set_flashdata("msg_type", $type);
    }

}

if (!function_exists('getContactsLabel')) {

    function getContactsLabel($contact) {
        if (is_array($contact)) {
            $contact = (object) $contact;
        }

        if ($contact->id_contact_type != 2 && $contact->id_contact_type != 3) {
            $libelle = $contact->nom . ' ' . $contact->prenom;
            if (!empty($contact->entreprise_name)) {
                $libelle .= ' (' . $contact->entreprise_name . ')';
            }
        } else {
            $libelle = $contact->entreprise_name;
            if (!empty($contact->nom) || !empty($contact->prenom)) {
                $libelle .= ' (' . $contact->prenom . ' ' . $contact->nom . ')';
            }
        }
        return $libelle;
    }

}


if (!function_exists('username')) {

    function username($user) {
        $user = (object) $user;
        $ret = $user->first_name . ' ' . $user->last_name;
        if ($user->agency_name) {
            $ret = $user->agency_name;
        }
        return $ret;
    }

}


if (!function_exists('ObjToArray')) {

    function ObjToArray($obj) {
        $arr = array();
        if (is_array($obj) || is_object($obj)) {
            foreach ($obj AS $k => $v) {
                if (is_object($v)) {
                    $arr[$k] = get_object_vars($v);
                } else if (is_array($v)) {
                    $arr[$k] = ObjToArray($v);
                } else {
                    $arr[$k] = $v;
                }
            }
        }
        return $arr;
    }

}

/**
 * Get domain
 *
 * Return the domain name only based on the "base_url" item from your config file.
 *
 * @access    public
 * @return    string
 */
if (!function_exists('getDomain')) {

    function getDomain($url = "") {
        if (empty($url)) {
            $url = base_url();
        }
        return preg_replace("/^[\w]{2,6}:\/\/([\w\d\.\-]+).*$/", "$1", $url);
    }

}

if (!function_exists('getReferer')) {

    function getReferer() {
        $url = "";
        if (site_url(uri_string()) != site_url('login')) {
            $url = site_url(uri_string());
        } else {
            $url = $_SERVER['HTTP_REFERER'];
        }
        return $url;
    }

}


if (!function_exists('generatePassword')) {

    function generatePassword($length = 15, $strength = 8) {
        $vowels = 'aeuy';
        $consonants = 'bdghjmnpqrstvz';
        if ($strength >= 1) {
            $consonants .= 'BDGHJLMNPQRSTVWXZ';
        }
        if ($strength >= 2) {
            $vowels .= "AEUY";
        }
        if ($strength >= 4) {
            $consonants .= '23456789';
        }
        if ($strength >= 8) {
            $consonants .= '@#$%';
        }

        $password = '';
        $alt = time() % 2;
        for ($i = 0; $i < $length; $i++) {
            if ($alt == 1) {
                $password .= $consonants[(rand() % strlen($consonants))];
                $alt = 0;
            } else {
                $password .= $vowels[(rand() % strlen($vowels))];
                $alt = 1;
            }
        }
        return $password;
    }

}

if (!function_exists('getLevelLanguage')) {

    function getLevelLanguage($level) {
        switch ($level) {
            case 'm':
                $ret = "Langue maternelle";
                break;
            case '1':
                $ret = "Connaissance parfaite";
                break;
            case '2':
                $ret = "Connaissance moyenne";
                break;
            case '3':
            default:
                $ret = "-";
                break;
        }
        return $ret;
    }

}

if (!function_exists('num_format')) {

    function num_format($num, $dec = 2) {
        return number_format($num, $dec, ", ", " ");
    }

}



if (!function_exists('encrypt')) {

    function encrypt($data) {
        if (!defined('ENCRYPT_KEY') || !ENCRYPT_KEY) {
            die('Please, define the encrypt key');
        }
        $key = ENCRYPT_KEY;
        if (is_array($data)) {
            $data = serialize($data);
        }
        $td = mcrypt_module_open(MCRYPT_DES, "", MCRYPT_MODE_ECB, "");
        $iv = mcrypt_create_iv(mcrypt_enc_get_iv_size($td), MCRYPT_RAND);
        mcrypt_generic_init($td, $key, $iv);
        $data = base64_encode(mcrypt_generic($td, '!' . $data));
        mcrypt_generic_deinit($td);
        return rawurlencode($data);
    }

}


if (!function_exists('decrypt')) {

    function decrypt($data) {
        if (!defined('ENCRYPT_KEY') || !ENCRYPT_KEY) {
            die('Please, define the encrypt key');
        }
        $data = rawurldecode($data);
        $key = ENCRYPT_KEY;
        $td = mcrypt_module_open(MCRYPT_DES, "", MCRYPT_MODE_ECB, "");
        $iv = mcrypt_create_iv(mcrypt_enc_get_iv_size($td), MCRYPT_RAND);
        mcrypt_generic_init($td, $key, $iv);
        $data = mdecrypt_generic($td, base64_decode($data));
        mcrypt_generic_deinit($td);

        if (substr($data, 0, 1) != '!')
            return false;

        $data = substr($data, 1, strlen($data) - 1);
        if (unserialize($data)) {
            $data = unserialize($data);
        }
        return $data;
    }

}

if (!function_exists('trim_array')) {

    function trim_array(&$arr) {
        foreach ($arr AS $k => &$v) {
            if (is_array($v)) {
                $v = trim_array($v);
            } else {
                $v = trim($v);
            }
        }
        return TRUE;
    }

}

if (!function_exists('generate_email_attachement')) {

    function generate_email_attachement($model, $id_franchise, $save_file = FALSE) {
        $CI = & get_instance();
        $CI->output->enable_profiler(FALSE);
        // Get & Set content
        $property = "franchise_" . $model;
        $data['franchise'] = $CI->data['franchises'][$id_franchise];
        $data['content'] = $data['franchise']->$property;
        $CI->load->library('MY_html2pdf');
        $pdfContent = $CI->my_html2pdf->getPdfContent($model . '.tpl', $data);
        if ($CI->input->get('debug')) {
            die($pdfContent);
        }
        // mPDF
        require_once('/home/libs/mPDF/mpdf.php');
        $html2pdf = new mPDF();
        $html2pdf->list_indent_first_level = 1;
        $html2pdf->setDefaultFont('helvetica');
        $html2pdf->writeHTML($pdfContent);
        // Filename & Output
//        if ($model == "reglement") {
//            $filename = "Conditions Générales de Vente " . $data['franchise']->franchise_name;
//        } else {
//            $filename = "Règlement " . $data['franchise']->franchise_name;
//        }
        $filename = ($model == "reglement") ? "Règlement" : "Conditions Générales de Vente";
        $filename .= " " . $data['franchise']->franchise_name . ".pdf";
        $directoy = FCPATH . 'files/';
        if ($save_file) {
            $save_file = 'F';
            if (!file_exists($directoy)) {
                mkdir($directoy, 0755, TRUE);
            }
            $filename = $directoy . $filename;
        } else {
            $save_file = 'I';
        }
        $html2pdf->Output($filename, $save_file);
        if ($save_file) {
            return $filename;
        }
    }

}
?>
