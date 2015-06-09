<?php

class MY_Exceptions extends CI_Exceptions {

    public function show_404($page = '', $log_error = TRUE) {
        if (is_cli()) {
            $heading = 'Not Found';
            $message = 'The controller/method pair you requested was not found.';
        } else {
            $heading = '404 Page Not Found';
            $message = 'The page you requested was not found.';
        }

        // By default we log this, but allow a dev to skip it
        if ($log_error) {
            log_message('error', $heading . ': ' . $page);
        }

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
        exit(4); // EXIT_UNKNOWN_FILE
    }

}
