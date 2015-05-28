<?php

class Cities_model extends MY_Model {

    protected $table;
    protected $id;
    protected $fields;
    protected $callback_insert;

    public function __construct() {
        parent::__construct();
        $this->table = strtolower(basename(__FILE__, '_model.php'));
        $this->id = "city_id";
        $this->fields = array(
            'city_slug',
            'city_name',
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
        $this->db->where('city_slug', $slug);
        return $this->db->get($this->table)->row();
    }

    public function get_by_user_id($user_id) {
        $ret = array();
        $this->db->select('*, '.$this->table.'.city_id AS city_id');
        $this->db->join('users_cities', 'users_cities.city_id = ' . $this->table . '.city_id', 'LEFT');
        $this->db->where('users_cities.user_id', $user_id);
        $list = $this->db->get($this->table)->result();
        foreach ($list AS $v) {
            $ret[$v->city_id] = $v;
        }
        return $ret;
    }

}
