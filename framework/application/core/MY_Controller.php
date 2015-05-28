<?php
class MY_Controller {
    
    public $smarty;
    
    public function __construct() {
        $this->smarty = $GLOBALS['smarty'];
    }
    
}

