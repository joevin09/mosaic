<?php

class Users_cities_model extends MY_Model {

    protected $table;
    protected $id;
    protected $fields;

    public function __construct() {
        parent::__construct();
        $this->table = strtolower(basename(__FILE__, '_model.php'));
        $this->id = "city_id";
        $this->fields = array(
            'user_id',
        );
    }

    public function insert_update($data) {
        $ret = FALSE;
        if (!empty($data['user_id'])) {
            $this->db->delete($this->table, array('user_id' => $this->user->user_id));
            foreach ($data['cities'] AS $city_id => $v) {
                $insert_data = array(
                    'user_id' => $data['user_id'],
                    'city_id' => $city_id,
                );
                if ($this->db->insert($this->table, $insert_data)) {
                    $ret = TRUE;
                }
            }
        }
        return $ret;
    }

    public function get_by_user_id($user_id) {
        $ret = array();
        $this->db->join('cities', 'cities.city_id = ' . $this->table . '.city_id', 'LEFT');
        $list = $this->db->get_where($this->table, array('user_id' => $user_id))->result();
        foreach ($list AS $v) {
            $ret[$v->city_id] = $v;
        }
        return $ret;
    }

}
