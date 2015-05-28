<?php

class MY_Model extends CI_Model {

    protected $table;
    protected $id;
    protected $fields;

    public function __construct() {
        parent::__construct();
    }

    public function count($params = "") {
        if (is_array($params) && $params['select']) {
            unset($params['select']);
        }
        if (is_array($params) && $params['order_by']) {
            unset($params['order_by']);
        }
        if (is_array($params) && $params['limit']) {
            unset($params['limit']);
        }
        if (is_array($params) && $params['offset']) {
            unset($params['offset']);
        }
        $this->db->select('COUNT(' . $this->id . ') AS num');
        $this->get_params($params);
        return $this->db->get($this->table)->row()->num;
    }

    public function get($params = "") {
        $this->get_params($params);
        return $this->db->get($this->table)->result();
    }

    public function get_row($params = "") {
        $this->get_params($params);
        return $this->db->get($this->table)->row();
    }

    public function insert_update($data) {
        if (empty($this->fields)) {
            die('insert_update: aucun champs défini');
        }
        if (is_object($data)) {
            $data = (array) $data;
        }

        $id = FALSE;
        if (!empty($data)) {
            $insert_data = array();
            foreach ($this->fields AS $v) {
                if (isset($data[$v])) {
                    if (is_array($data[$v])) {
                        trim_array($v);
                        $data[$v] = serialize($data[$v]);
                    } else {
                        $data[$v] = trim($data[$v]);
                    }
                    $insert_data[$v] = $data[$v];
                }
            }

            $pk_exists = $this->pk_exists($data);
            if (isset($data[$this->id]) && $data[$this->id] > 0 && !$pk_exists) {
                $insert_data[$this->id] = $data[$this->id];
            }
            if (empty($insert_data)) {
                die('SQL EROOR, no data in ' . $this->table);
            }
            if ($pk_exists) {
                if (isset($this->fields['updated'])) {
                    $insert_data['updated'] = date('Y-m-d H:i:s');
                }
                if (isset($this->fields['date_update'])) {
                    $insert_data['date_update'] = date('Y-m-d H:i:s');
                }
                if (isset($this->callback_update)) {
                    $this->{$this->callback_update}($insert_data, $data[$this->id]);
                }
                if ($this->db->update($this->table, $insert_data, $this->update_where($data))) {
                    $id = $data[$this->id];
                }
            } else {
                if (isset($this->fields['created'])) {
                    $insert_data['created'] = date('Y-m-d H:i:s');
                }
                if (isset($this->fields['date_creation'])) {
                    $insert_data['date_creation'] = date('Y-m-d H:i:s');
                }
                if (isset($this->fields['id_user_created'])) {
                    $insert_data['id_user_created'] = $this->data['user']->id_user;
                }
                if (isset($this->callback_insert)) {
                    $this->{$this->callback_insert}($insert_data);
                }
                $this->db->insert($this->table, $insert_data);
                if (isset($data[$this->id]) && $data[$this->id]) {
                    $id = $data[$this->id];
                } else {
                    $id = $this->db->insert_id();
                }
            }
        }
        return $id;
    }

    public function update_where($data) {
        return array($this->id => $data[$this->id]);
    }

    public function pk_exists($data) {
        $pk_exists = FALSE;
        if (isset($data[$this->id]) && $data[$this->id] > 0) {
            $pk_exists = $this->db->get_where($this->table, array($this->id => $data[$this->id]))->row();
            if (!empty($pk_exists)) {
                $pk_exists = TRUE;
            }
        }
        return $pk_exists;
    }

    public function remove($params = "") {
        if (is_numeric($params) || isset($params['where'])) {
            $this->get_params($params);
        } else {
            $this->db->where($params);
        }
        return $this->db->delete($this->table);
    }

    public function truncate_table() {
        $this->db->query('TRUNCATE TABLE `' . $this->table . '`');
    }

    public function get_params($params, $table = "", $id = "") {
        $table = ($table) ? $table : $this->table;
        $id = ($id) ? $id : ($this->id) ? $this->id : 'id';
        if (empty($table) || empty($id)) {
            die('get_params: aucune table et/ou id défini');
        }
        if (is_array($params)) {
            if (!empty($params['select'])) {
                $this->db->select($params['select']);
            }
            if (!empty($params['select_age'])) {
                if (empty($params['select'])) {
                    $this->db->select('*');
                }
                $this->db->select("CURRENT_DATE,
                                (YEAR(CURRENT_DATE)-YEAR(" . $params['select_age'] . "))
                                - (RIGHT(CURRENT_DATE,5)<RIGHT(" . $params['select_age'] . ",5))
                                AS age", FALSE);
            }
            if (is_array($params['order_by'])) {
                foreach ($params['order_by'] AS $k => $v) {
                    if ($k == 'field') {
                        $this->db->_protect_identifiers = FALSE;
                        $this->db->order_by($v);
                        $this->db->_protect_identifiers = TRUE;
                    } else {
                        $this->db->order_by($v);
                    }
                }
            } else if (!empty($params['order_by'])) {
                $this->db->order_by($params['order_by']);
            }

            if ($params['limit'] && strlen($params['offset']) > 0) {
                $this->db->limit($params['limit'], $params['offset']);
            } else if ($params['limit']) {
                $this->db->limit($params['limit']);
            }
            if (!empty($params['where'])) {
                foreach ($params['where'] AS $k => $v) {
                    $this->db->where($k, $v);
                }
            }
            if (!empty($params['where_in'])) {
                foreach ($params['where_in'] AS $k => $v) {
                    $this->db->where_in($k, $v);
                }
            }
            if (!empty($params['like'])) {
                foreach ($params['like'] AS $k => $v) {
                    $this->db->like($k, $v);
                }
            }
            if (!empty($params['or_likes'])) {
                foreach ($params['or_likes'] AS $v) {
                    $this->db->where("(" . $this->db->compile_binds($v['sql'], $v['binds']) . ")");
                }
            }
        } else if (is_numeric($params)) {
            $this->db->where(array($table . '.' . $id => $params));
        }
    }

}

?>
