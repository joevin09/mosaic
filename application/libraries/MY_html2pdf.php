<?php

class MY_html2pdf {

    private $CI;
    public $canvas_dir;

    public function __construct() {
        $this->CI = & get_instance();
        $this->canvas_dir = APPPATH . 'views/html2pdf/';
    }

    public function getPdfContent($tpl_name, $data = "") {
        $data['franchises'] = $this->CI->data['franchises'];
        $templateDir = $this->CI->smarty->smarty->getTemplateDir();
        $this->CI->smarty->smarty->setTemplateDir($this->canvas_dir);
        $str = $this->CI->smarty->get_content($tpl_name, $data);
        $this->CI->smarty->smarty->setTemplateDir($templateDir);
        return $str;
    }

}

?>
