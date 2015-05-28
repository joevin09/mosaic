<?php

class MY_URI extends CI_URI {

    public function __construct() {
        parent::__construct();
    }

    function _reindex_segments() {
        parent::_explode_segments();
        if ($this->segments[0] == "admin") {
            define('SIDE', 'admin');
        } else {
            define('SIDE', 'public');
        }
    }

}

?>
