<?php

class Professions_status_model extends MY_Model {

    protected $table;
    protected $id;
    protected $fields;

    public function __construct() {
        parent::__construct();
        $this->table = strtolower(basename(__FILE__, '_model.php'));
        $this->id = "profession_status_id";
        $this->fields = array(
            'profession_slug',
            'profession_name',
            'menu_order',
        );
    }

    public function get_by_slug($slug) {
        $this->db->where('profession_slug', $slug);
        return $this->db->get($this->table)->row();
//        echo '<pre>' . print_r($slug->db->insert_id(), true) . '</pre>';
    }
//
//    public function get_by_user_id($user_id) {
//        $ret = array();
//        $this->db->select('*, ' . $this->table . '.profession_id AS profession_id');
//        $this->db->join('profession_statut', 'profession_statut.profession_id = ' . $this->table . '.profession_id', 'LEFT');
//        $this->db->where('profession_statut.user_id', $user_id);
//        $list = $this->db->get($this->table)->result();
//        foreach ($list AS $v) {
//            $ret[$v->profession_id] = $v;
//        }
//        return $ret;
//    }

}
