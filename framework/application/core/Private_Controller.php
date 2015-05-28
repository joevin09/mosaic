<?php

class Private_Controller extends Public_Controller {
    public function __construct() {
        if (empty($_SESSION['user_id'])) {
            header('Location: '.site_url());
            exit;
        }
    }
}
