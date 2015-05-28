<?php

class Profil extends Private_Controller {

    public function index() {
        echo '<pre>' . print_r($_SESSION, true) . '</pre>';
    }

}
