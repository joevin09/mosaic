<?php

class Users_functions_model extends MY_Model {

    protected $table;
    protected $id;
    protected $fields;
    protected $callback_insert;

    public function __construct() {
        parent::__construct();
        $this->table = strtolower(basename(__FILE__, '_model.php'));
        $this->id = "function_id";
        $this->fields = array(
            'user_id',
        );
    }

    public function insert_update($data) {
        $ret = FALSE;
        if (!empty($data['user_id'])) {
            $this->db->delete($this->table, array('user_id' => $data['user_id']));
            foreach ($data['functions'] AS $function_id => $v) {
                $insert_data = array(
                    'user_id' => $data['user_id'],
                    'function_id' => $function_id,
                );
                $ret = $this->db->insert($this->table, $insert_data);
                $user_function_id = $this->db->insert_id();
                if ($user_function_id > 0 && !empty($data['experiences'][$function_id])) {
                    $this->load->model('users_experiences_model');
                    $experiences_data = array(
                        'user_function_id' => $user_function_id,
                        'experience_id' => $data['experiences'][$function_id],
                    );
                    $this->users_experiences_model->insert_update($experiences_data);
                }
            }
        }
        return $ret;
    }

    public function get_by_user_id($user_id) {
        $ret = array();
        $this->db->select('*, functions.function_id AS function_id');
        $this->db->join($this->table, $this->table.'.function_id = functions.function_id', 'LEFT');
        $this->db->join('users_experiences', 'users_experiences.user_function_id = ' . $this->table . '.user_function_id', 'LEFT');
        $this->db->where('users_functions.user_id', $user_id);
        $list = $this->db->get('functions')->result();
        foreach ($list AS $v) {
            $ret[$v->function_id] = $v;
        }
        return $ret;
    }
}
