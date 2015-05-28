<?php

class Users_experiences_model extends MY_Model {

    protected $table;
    protected $id;
    protected $fields;

    public function __construct() {
        parent::__construct();
        $this->table = strtolower(basename(__FILE__, '_model.php'));
        $this->id = "user_function_id";
        $this->fields = array(
            'experience_id',
        );
    }

}
