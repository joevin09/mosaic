<?php

class Experiences_model extends MY_Model {

    protected $table;
    protected $id;
    protected $fields;
    protected $callback_insert;

    public function __construct() {
        parent::__construct();
        $this->table = strtolower(basename(__FILE__, '_model.php'));
        $this->id = "experience_id";
        $this->fields = array(
            'experience_slug',
            'experience_name',
            'menu_order',
        );
    }

    public function get_by_slug($slug) {
        $this->db->where('experience_slug', $slug);
        return $this->db->get($this->table)->row();
    }

    public function get_by_user_id($user_id) {
        $ret = array();
        $this->db->select('*, '.$this->table.'.experience_id AS experience_id');
        $this->db->join('users_experiences', 'users_experiences.experience_id = ' . $this->table . '.experience_id', 'LEFT');
        $this->db->where('users_experiences.user_id', $user_id);
        $list = $this->db->get($this->table)->result();
        foreach ($list AS $v) {
            $ret[$v->experience_id] = $v;
        }
        return $ret;
    }
}
