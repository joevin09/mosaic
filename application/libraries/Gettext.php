<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Codeigniter PHP framework library class for dealing with gettext.
 *
 * @package     CodeIgniter
 * @subpackage    Libraries
 * @category	Language
 * @author	Marko Martinović <marko@techytalk.info>
 * @link	https://github.com/Marko-M/codeigniter-gettext
 */
class Gettext {

    private $CI;

    public function __construct() {
        $this->CI = & get_instance();
        $this->CI->load->model('Languages_model');
        $l = $this->CI->data['languages'] = $this->CI->Languages_model->get();

        if (SIDE === "public") {
            $locale = $this->_get_locale();
        }

        $languages = array();
        foreach ($l AS $v) {
            $languages[$v->iso] = $v;
        }

        $lang = $languages[$locale];
        $this->CI->session->set_userdata('lang', $locale);
        $_SESSION['lang'] = $_COOKIE['lang'] = $locale;
        $this->CI->load->config('gettext');
        $this->CI->config->set_item('default_language', $this->CI->config->item('language'));
        $this->CI->config->set_item('lang_id', $lang->id);
        //$this->CI->config->set_item('language', $lang->language);
        $this->CI->config->set_item('lang', $lang->iso);
        $this->CI->config->set_item('language_name', $lang->name);      // Language names : https://fr.wikipedia.org/wiki/Liste_des_codes_ISO_639-1
        $this->CI->config->set_item('gettext_locale', $lang->lcid);     // LCID : http://www.science.co.il/language/locale-codes.asp
        $this->CI->config->gettext_locale = $lang->lcid;

        define('CURRENT_LOCALE', $locale);
        $this->_init();
    }

    private function _get_locale() {
        if (config_item('lang_url') == "prepend") {
            $browser_lang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
            $locale = "";
            $segment = $this->CI->uri->segment(0);
            foreach ($this->CI->data['languages'] AS $v) {
                if ($v->iso == $segment || (empty($locale) && $v->iso == $browser_lang) || (empty($locale) && $v->default)) {
                    $locale = $v->iso;
                }
                if ($v->default) {
                    $this->CI->config->set_item('default_iso', $v->iso);
                }
            }
            if (empty($segment)) {
                redirect(base_url($locale), 'refresh');
                exit;
            }
        } else {
            if ($_GET['lang']) {
                $locale = $_GET['lang'];
            } else if ($this->CI->session->userdata('lang')) {
                $locale = $this->CI->session->userdata('lang');
            } else {
                $locale = 'fr';
            }
        }
        return $locale;
    }

    private function _init() {
        // Merge $config and config/gettext.php $config
        $config = array(
            'gettext_locale_dir' => $this->CI->config->item('gettext_locale_dir'),
            'gettext_text_domain' => $this->CI->config->item('gettext_text_domain'),
            'gettext_catalog_codeset' => $this->CI->config->item('gettext_catalog_codeset'),
            'gettext_locale' => $this->CI->config->item('gettext_locale'),
            'gettext_nocache' => $this->CI->config->item('gettext_nocache'),
        );
        
        if ($this->CI->config->item('language') != $this->CI->config->item('default_language') || config_item('default_iso') != config_item('lang')) {
            if ($this->CI->config->item('gettext_nocache')) {
                $this->_bind_gettext_nocache($config);
            } else {
                $this->_bind_gettext($config);
            }
        }
        // Gettext locale
        setlocale(LC_ALL, $config['gettext_locale'] . '.' . $config['gettext_catalog_codeset']);
        putenv("LC_ALL=" . $config['gettext_locale']);
        putenv('LANG=' . $config['gettext_locale'] . '.' . $config['gettext_catalog_codeset']);
        putenv('LANGUAGE=' . $config['gettext_locale'] . '.' . $config['gettext_catalog_codeset']);
    }

    private function _bind_gettext($config) {
        $domain = $config['gettext_text_domain'];
        // Gettext catalog codeset
        bind_textdomain_codeset($domain, $config['gettext_catalog_codeset']);

        // Path to gettext locales directory relative to APPPATH
        bindtextdomain($domain, APPPATH . $config['gettext_locale_dir']);

        // Gettext domain
        textdomain($domain);
    }

    private function _bind_gettext_nocache($config) {
        $filepath = APPPATH . $config['gettext_locale_dir'] . "/" . $config['gettext_locale'] . "/LC_MESSAGES/";
        $filename = $config['gettext_text_domain'] . ".mo";
        $mtime = filemtime($filepath . $filename);
        // our new unique .MO file
        $filename_new = $filepath . $config['gettext_text_domain'] . "_" . $mtime . ".mo";
        if (!file_exists($filename_new)) {  // check if we have created it before
            // if not, create it now, by copying the original
            copy($filepath . $filename, $filename_new);
        }
        // compute the new domain name
        $domain_new = $config['gettext_text_domain'] . "_" . $mtime;
        $config['gettext_text_domain'] = $domain_new;
        $this->_bind_gettext($config);
    }

    private function _get_browser_language($defLang) {
        $l = NULL;
        if (isset($_SERVER["HTTP_ACCEPT_LANGUAGE"])) {
            $l = $_SERVER["HTTP_ACCEPT_LANGUAGE"];
        }
        return $this->_parseDefaultLanguage($l, $defLang);
    }

    private function _parseDefaultLanguage($http_accept, $deflang = "en") {
        if (isset($http_accept) && strlen($http_accept) > 1) {
            # Split possible languages into array
            $x = explode(",", $http_accept);
            foreach ($x as $val) {
                #check for q-value and create associative array. No q-value means 1 by rule
                if (preg_match("/(.*);q=([0-1]{0,1}\.\d{0,4})/i", $val, $matches))
                    $lang[$matches[1]] = (float) $matches[2];
                else
                    $lang[$val] = 1.0;
            }

            #return default language (highest q-value)
            $qval = 0.0;
            foreach ($lang as $key => $value) {
                if ($value > $qval) {
                    $qval = (float) $value;
                    $deflang = $key;
                }
            }
        }
        return substr(strtolower($deflang), 0, 2);
    }

}

/* End of file Gettext.php */