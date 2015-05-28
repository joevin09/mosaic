<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

// Load Smarty
require_once('/home/libs/Smarty3/Smarty.class.php');

class CI_Smarty extends Smarty {

    function __construct() {
        ob_start();
        parent::__construct();
        $this->setTemplateDir(APPPATH . 'views/templates');
        $this->setCompileDir(APPPATH . 'views/compiled');
        $this->setConfigDir(APPPATH . 'libraries/smarty/configs');
        $this->setCacheDir(APPPATH . 'libraries/smarty/cache');

        $this->assign('APPPATH', APPPATH);
        $this->assign('BASEPATH', BASEPATH);
        if (method_exists($this, 'assignByRef')) {
            $ci = & get_instance();
            $this->assignByRef("this", $ci);
        }
        $this->init();

        log_message('debug', "Smarty Class Initialized");
    }

    public function init() {
        $ci = & get_instance();
        if (MY_DEBUG && !$ci->input->is_ajax_request()) {
            ini_set('display_errors', '1');
            $ci->output->enable_profiler(TRUE);
        } else {
            ini_set('display_errors', '0');
            error_reporting(0);
        }
        // Init Smarty
        $this->smarty = new Smarty();
        $this->smarty->error_reporting = (MY_DEBUG) ? E_ALL & ~E_NOTICE : FALSE;
        $this->smarty->left_delimiter = "<{";
        $this->smarty->right_delimiter = "}>";
        $this->smarty->caching = FALSE;
        $this->smarty->cache_lifetime = 120;
        $this->smarty->force_compile = (MY_DEBUG) ? TRUE : FALSE;

        $this->SetUserTemplateDir();

        $this->smarty->setConfigDir(APPPATH . 'cache/templates_c/');
        $this->smarty->setCompileDir(APPPATH . 'cache/templates_c/');
        $this->smarty->setCacheDir(APPPATH . 'cache/templates_c/smartycache/');
    }

    public function SetUserTemplateDir() {
        $ci = & get_instance();
        if (SIDE == 'admin') {
            $this->smarty->setTemplateDir(APPPATH . 'views/admin/');
            $ci->config->set_item('template_admin', 'default');
        } else if (!empty($_GET['template'])) {
            $this->smarty->setTemplateDir(APPPATH . 'views/public/' . $_GET['template'] . '/');
            $ci->config->set_item('template_public', $_GET['template']);
        } else {
            $this->smarty->setTemplateDir(APPPATH . 'views/public/' . config_item('template_public') . '/');
        }
        $this->scanSubfolders();
    }

    function view($template_name, $data = "") {
        $ci = & get_instance();
        if (!class_exists('Console')) {
            $ci->load->library('console');
        }
        if (strpos($template_name, '.') === FALSE && strpos($template_name, ':') === FALSE) {
            $template_name .= '.tpl';
        }
        if (!empty($data)) {
            foreach ($data as $key => $val) {
                $ci->smarty->assign($key, $val);
            }
        }
        $template_name = strtolower($template_name);
        if (!empty($_GET['nocanvas'])) {
            $template_name = "extends:_nocanvas.tpl|" . $template_name;
        } else if (!empty($_GET['canvas']) && $_GET['canvas'] != '_dhtml') {
            $template_name = "extends:" . $_GET['canvas'] . ".tpl|" . $template_name;
        } else {
            $template_name = "extends:_canvas.tpl|" . $template_name;
        }
        $ouput_in_controller = trim(ob_get_clean());
        $ci->console->log($ouput_in_controller, 'log');
        parent::display($template_name);
    }

    function get_content($template_name, $data = "") {
        $ci = & get_instance();
        if (!class_exists('Console')) {
            $ci->load->library('console');
        }
        if (strpos($template_name, '.') === FALSE && strpos($template_name, ':') === FALSE) {
            $template_name .= '.tpl';
        }
        if (!empty($data)) {
            foreach ($data as $key => $val) {
                $ci->smarty->assign($key, $val);
            }
        }
        $ouput_in_controller = trim(ob_get_clean());
        $ci->console->log($ouput_in_controller, 'log');
        return parent::fetch($template_name);
    }

    function fetch_content($template_name, $data = "") {
        if (strpos($template_name, '.') === FALSE && strpos($template_name, ':') === FALSE) {
            $template_name .= '.tpl';
        }
        if (!empty($data)) {
            $ci = & get_instance();
            foreach ($data as $key => $val) {
                $ci->smarty->assign($key, $val);
            }
        }
        return parent::fetch($template_name);
    }

    private function scanSubfolders($subdir = "") {
        if (empty($subdir)) {
            $subdir = $this->smarty->getTemplateDir();
            $subdir = $subdir[0];
        }
        $subfolders = scandir($subdir);
        if (!empty($subfolders)) {
            foreach ($subfolders AS $v) {
                $dir = $subdir . $v . '/';
                if (substr($v, 0, 1) != '.' && is_dir($dir) && $v != '_assets') {
                    $this->smarty->addTemplateDir($dir);
                    $this->scanSubfolders($dir);
                }
            }
        }
    }

}

?>