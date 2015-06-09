<?php

class Users_model extends MY_Model {

    protected $table;
    protected $id;
    protected $fields;
    protected $callback_insert;

    public function __construct() {
        parent::__construct();
        $this->table = strtolower(basename(__FILE__, '_model.php'));
        $this->id = "user_id";
        $this->fields = array(
            'profession_status_id',
            'last_name',
            'first_name',
            'agency_name',
            'nbr_member',
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
            'competences',
            'process',
            'process_date',
            'offer',
            'offer_url'
           
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

            $competences = $data['competences'];
            $str = str_replace(array('-', ';', ','), ' ', $competences);
            
            $data['website'] = str_replace(array('http://', 'www.', 'https://', 'http://www.', 'https://www.'), '', $data['website']);
         
            $data['passwd'] = sha1($data['passwd']);
            // Process
            
            if ($data['process-1'] != "") {
                $data['process'] = $data['process-1'];
            }
            if ($data['process-2'] != "") {
                $data['process'] = $data['process'] . "/" . $data['process-2'];
            }
            if ($data['process-3'] != "") {
                $data['process'] = $data['process'] . "/" . $data['process-3'];
            }
            
            // Aujrd

            if ($data['today-1'] != "") {
                $data['process-1-date-2'] = $data['today-1'];
            }

            if ($data['today-2'] != "") {
                $data['process-2-date-2'] = $data['today-2'];
            }

            if ($data['today-3'] != "") {
                $data['process-3-date-2'] = $data['today-3'];
            }


            $data['process_date'] = $data['process-1-date-1'] . " " . $data['process-1-date-2'] . " " . $data['process-2-date-1'] . " " . $data['process-2-date-2'] . " " . $data['process-3-date-1'] . " " . $data['process-3-date-2'];
            
//            print_r($data['process_date']);
//            

            $data['competences'] = $str;
            
            
            
            // Agency Offert
            
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
            
            if ($data['offerurl-1'] != "") {
                $data['offer_url'] = $data['offerurl-1'];
            }
            if ($data['offerurl-2'] != "") {
                $data['offer_url'] = $data['offer_url'] . " " . $data['offerurl-2'];
            }
            if ($data['offerurl-3'] != "") {
                $data['offer_url'] = $data['offer_url'] . " " . $data['offerurl-3'];
            }
            if ($data['offerurl-4'] != "") {
                $data['offer_url'] = $data['offer_url'] . " " . $data['offerurl-4'];
            }
            
            if($data['offer_url']){
                $data['offer_url'] = str_replace(array('http://', 'www.', 'https://', 'http://www.', 'https://www.'), '', $data['offer_url']);
            }
           

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
        if (isset($params['experience']) && !empty($params['experience'])) {
            $this->load->model('experiences_model');
            $experience_id = $this->experiences_model->get_by_slug($params['experience'])->experience_id;
        }
//        if (isset($params['city']) && !empty($params['city'])) {
//            $this->load->model('cities_model');
//            $city_id = $this->cities_model->get_by_slug($params['city'])->city_id;
//        }
        if (isset($params['profession_status']) && !empty($params['profession_status'])) {
            $this->load->model('professions_status_model');
            $profession_status_id = $this->professions_status_model->get_by_slug($params['profession_status'])->profession_status_id;
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
        // SEARCH : Experiences
        if (isset($params['experience']) && !empty($params['experience'])) {
            if (!isset($params['function']) || empty($params['function'])) {
                $this->db->join('users_functions', 'users_functions.user_id = users.user_id', 'LEFT');
            }
            $this->db->join('users_experiences', 'users_experiences.user_function_id = users_functions.user_function_id', 'LEFT');
            $this->db->join('experiences', 'experiences.experience_id = users_experiences.experience_id', 'LEFT');
            $this->db->where('users_experiences.experience_id', $experience_id);
        }
//        // SEARCH : Cities
//        if (isset($params['city']) && !empty($params['city'])) {
//            $this->db->join('users_cities', 'users_cities.user_id = users.user_id', 'LEFT');
//            $this->db->join('cities', 'cities.city_id = users_cities.city_id', 'LEFT');
//            $this->db->where('users_cities.city_id', $city_id);
//        }
        // SEARCH : Profession Status
        if (isset($params['profession_status']) && !empty($params['profession_status'])) {
            $this->db->where($this->table . '.profession_status_id', $profession_status_id);
        }

        // Remove current user logged in from results
        if ($this->user->user_id > 0) {
            $this->db->where($this->table . '.user_id !=', $this->user->user_id);
        }
        $this->db->where('agency_name IS NULL', NULL);
        $this->db->order_by('created DESC');
        $this->db->limit(16);
        // Exec the query & return results as array of objects
        return $this->db->get($this->table)->result();
    }

}
