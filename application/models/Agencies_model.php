<?php

class Agencies_model extends MY_Model {

    protected $table;
    protected $id;
    protected $fields;
    protected $callback_insert;

    public function __construct() {
        parent::__construct();
        $this->table = strtolower(basename('users', '_model.php'));
        $this->id = "user_id";
        $this->fields = array(
            'profession_status_id',
            'last_name',
            'first_name',
            'agency_name',
            'nbr_member_id',
            'passwd',
            'change_passwd_code',
            'change_passwd_date',
            'email',
            'website',
            'sexe',
            'town',
            'web_statut',
            'birthday',
            'about',
            'avatar',
            'last_search_uri',
            'created',
//            'offer',
//            'offer_url'
        );
        $this->callback_insert = "callback_insert";
        $this->load->model('functions_model');
        $this->load->model('users_functions_model');
    }

    public function get($params = "") {
        $params = $this->set_params($params);
        if ($this->user->user_id > 0) {
            $params['where']['user_id !='] = $this->user->user_id;
        }
        $users = parent::get($params);
        foreach ($users AS &$v) {
            $v->functions = $this->users_functions_model->get_by_user_id($v->user_id);
        }
        unset($v);
        return $users;
    }

    public function get_row($params = "") {
        $params = $this->set_params($params);
        $user = parent::get_row($params);
        $user_functions = $this->users_functions_model->get_by_user_id($user->user_id);
        if (!empty($user_functions)) {
            $user->functions = $user_functions;
        }
        $this->load->model('users_cities_model');
        $user_cities = $this->users_cities_model->get_by_user_id($user->user_id);
        if (!empty($user_cities)) {
            $user->cities = $user_cities;
        }
        return $user;
    }

    public function set_params($params) {
        if (is_numeric($params)) {
            $ret = parent::get_params($params);
        } else {
            $ret = $default_params = array(
                'select_age' => 'birthday',
                'order_by' => 'created DESC',
            );
            if (!empty($params) && is_array($params)) {
                $ret = array_merge($default_params, $params);
            }
        }
        return $ret;
    }

    public function callback_insert(&$insert_data) {
        if (isset($insert_data['passwd'])) {
            $insert_data['passwd'] = sha1($insert_data['passwd']);
        }
    }

    public function check_login_passwd($login, $passwd) {
        $passwd = sha1($passwd);
        $p = array(
            'select' => 'user_id, email, passwd',
            'where' => array(
                'email' => $login,
                'passwd' => $passwd,
            ),
        );
        return $this->get_row($p)->user_id;
    }

    public function get_user_by_email($email) {
        $p = array(
            'where' => array(
                'email' => $email,
            ),
        );
        return $this->get_row($p);
    }

    public function update_user_profil($data) {
        $ret = FALSE;
        if (!empty($this->user->user_id)) {
            $data['user_id'] = $this->user->user_id;

            $data['website'] = str_replace(array('http://', 'www.', 'https://', 'http://www.', 'https://www.'), '', $data['website']);

            // Offer

            if ($data['offer-1'] != "") {
                $data['offer'] = $data['offer-1'];
            }
            if ($data['offer-2'] != "") {
                $data['offer'] = $data['offer'] . "/" . $data['offer-2'];
            }
            if ($data['offer-3'] != "") {
                $data['offer'] = $data['offer'] . "/" . $data['offer-3'];
            }
            if ($data['offer-4'] != "") {
                $data['offer'] = $data['offer'] . "/" . $data['offer-4'];
            }
            
//            var_dump($data);
//            die();



            $ret = $this->insert_update($data);
            if ($ret && isset($data['functions'])) {
                // Update functions details
                $ret = $this->users_functions_model->insert_update($data);
            }
            if ($ret && isset($data['cities'])) {
                // Update cities details
                $this->load->model('users_cities_model');
                $ret = $this->users_cities_model->insert_update($data);
            }
        }
        return $ret;
    }

    public function search($params) {
        /**
         * Define IDs
         */
        if (isset($params['function']) && !empty($params['function'])) {
            $function_id = $this->functions_model->get_by_slug($params['function'])->function_id;
        }
        if (isset($params['city']) && !empty($params['city'])) {
            $this->load->model('cities_model');
            $city_id = $this->cities_model->get_by_slug($params['city'])->city_id;
        }
        /**
         * Set search joins
         */
        // SEARCH : Functions
        if (isset($params['function']) && !empty($params['function'])) {
            $this->db->join('users_functions', 'users_functions.user_id = users.user_id', 'LEFT');
            $this->db->join('functions', 'functions.function_id = users_functions.function_id', 'LEFT');
            $this->db->where('users_functions.function_id', $function_id);
        }
        // SEARCH : Cities
        if (isset($params['city']) && !empty($params['city'])) {
            $this->db->join('users_cities', 'users_cities.user_id = users.user_id', 'LEFT');
            $this->db->join('cities', 'cities.city_id = users_cities.city_id', 'LEFT');
            $this->db->where('users_cities.city_id', $city_id);
        }

        // SEARCH : Nombre de membres
        if (isset($params['nbr_member']) && !empty($params['nbr_member'])) {

            $ranges = explode("-", $params['nbr_member']);
            if (count($ranges) === 2) {
                $this->db->where(array(
                    'nbr_member >=' => $ranges[0],
                    'nbr_member <' => $ranges[1],
                ));
            } else if (is_numeric($params['nbr_member'])) {
                $this->db->where('nbr_member >=', $params['nbr_member']);
            }
        }

        // Remove current user logged in from results
        if ($this->user->user_id > 0) {
            $this->db->where($this->table . '.user_id !=', $this->user->user_id);
        }
        $this->db->where('agency_name IS NOT NULL', NULL);
        $this->db->order_by('created DESC');
        $this->db->limit(16);
        // Exec the query & return results as array of objects
        return $this->db->get($this->table)->result();
    }

}
