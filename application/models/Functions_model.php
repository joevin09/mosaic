<?php

class Functions_model extends MY_Model {

    protected $table;
    protected $id;
    protected $fields;
    protected $callback_insert;

    public function __construct() {
        parent::__construct();
        $this->table = strtolower(basename(__FILE__, '_model.php'));
        $this->id = "function_id";
        $this->fields = array(
            'function_slug',
            'function_name',
            'menu_order',
        );
    }

    public function get_by_slug($slug) {
//        $p = array(
//            'where' => array(
//                'function_slug' => $slug,
//            ),
//        );
//        return $this->get_row($p);
        $this->db->where('function_slug', $slug);
        return $this->db->get($this->table)->row();
    }
//
//    public function get_with_experiences($user_id) {
//        $this->db->join('users_experiences', 'users_experiences.user_function_id = users_functions.user_function_id', 'LEFT');
//        return $this->db->get_where('users_functions', array('user_id' => $user_id)->result());
//    }

}
