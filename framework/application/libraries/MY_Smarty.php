<?php

require_once(BASEPATH . 'third_party/Smarty3/Smarty.class.php');

class MY_Smarty extends Smarty {

    public function __construct() {
        parent::__construct();

        $this->setTemplateDir(BASEPATH . 'views');
        $this->setCompileDir(BASEPATH . 'cache/compiled');
        $this->setConfigDir(BASEPATH . 'config');
        $this->setCacheDir(BASEPATH . 'cache');

        $this->left_delimiter = "<{";
        $this->right_delimiter = "}>";
        $this->error_reporting = TRUE;
        $this->caching = FALSE;
        $this->force_compile = TRUE;
    }

    public function view($template, $data = "") {
        if (!empty($data)) {
            foreach ($data AS $k => $v) {
                $this->assign($k, $v);
            }
        }
        $this->display('extends:_canvas.tpl|' . strtolower($template));
    }

}
