<?php

class Errors extends Public_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function error_404() {
        header("HTTP/1.1 404 Not Found");
        $heading = "404 Page Not Found";
        $message = "The page you requested was not found ";
        $status_code = "404";


        set_status_header(404);
        $data['heading'] = $heading;
        $data['message'] = $message;
        $data['status_code'] = $status_code;
        if ($this->smarty) {
            //$_GET['canvas'] = '_errors.tpl';
            $this->smarty->view('_errors.tpl', $data);
        } else if ($status_code == 404 || MY_DEBUG) {
            $message = '<p>' . implode('</p><p>', (!is_array($message)) ? array($message) : $message) . '</p>';
            if (ob_get_level() > $this->ob_level + 1) {
                ob_end_flush();
            }
            ob_start();
            include(APPPATH . 'errors/' . $template . '.php');
            $buffer = ob_get_contents();
            ob_end_clean();
            echo $buffer;
        }
    }

}

?>
