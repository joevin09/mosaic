<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Parser extends MY_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        show_error('PLEASE, SPECIFY A VALID FILE TO PARSE', 500);
        die();
    }

    public function assets() {
        $file = implode('/', func_get_args());
        $file = APPPATH . 'views/' . SIDE . '/' . get_template_name() . '/_' . __FUNCTION__ . '/' . $file;
        if (file_exists($file)) {
            header('Content-Type: ' . $this->get_mime_type($file));
            echo $this->smarty->fetch($file);
        } else {
            show_error('File not found', 404);
            die();
        }
        die();
    }

    private function get_mime_type($ext) {
        if (preg_match('#\.#', $ext)) {
            $ext = pathinfo($ext, PATHINFO_EXTENSION);
        }
        switch ($ext) {
            case "js":
                return "application/x-javascript";
            case "json":
                return "application/json";
            case "jpg":
            case "jpeg":
            case "jpe":
                return "image/jpg";
            case "png":
            case "gif":
            case "bmp":
            case "tiff":
                return "image/" . strtolower($matches[1]);
            case "css":
                return "text/css";
            case "xml":
                return "application/xml";
            case "doc":
            case "docx":
                return "application/msword";
            case "xls":
            case "xlt":
            case "xlm":
            case "xld":
            case "xla":
            case "xlc":
            case "xlw":
            case "xll":
                return "application/vnd.ms-excel";
            case "ppt":
            case "pps":
                return "application/vnd.ms-powerpoint";
            case "rtf":
                return "application/rtf";
            case "pdf":
                return "application/pdf";
            case "html":
            case "htm":
            case "php":
                return "text/html";
            case "txt":
                return "text/plain";
            case "mpeg":
            case "mpg":
            case "mpe":
                return "video/mpeg";
            case "mp3":
                return "audio/mpeg3";
            case "wav":
                return "audio/wav";
            case "aiff":
            case "aif":
                return "audio/aiff";
            case "avi":
                return "video/msvideo";
            case "wmv":
                return "video/x-ms-wmv";
            case "mov":
                return "video/quicktime";
            case "zip":
                return "application/zip";
            case "tar":
                return "application/x-tar";
            case "swf":
                return "application/x-shockwave-flash";
        }
    }

}