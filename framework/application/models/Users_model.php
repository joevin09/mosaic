<?php

class Users_model {

    public function get_user_by_id($id) {
        if (empty($id)) {
            return false;
        }
        // $sql = "SELECT * FROM users WHERE id = '" . $id . "'";
        // Juste un petit plus, pour avoir l'age de la personne :
        $sql = "SELECT *, "
                . "DATE_FORMAT(FROM_DAYS(TO_DAYS(NOW())-TO_DAYS(`naissance`)), '%Y')+0 AS age "
                . "FROM users WHERE id = '" . $id . "'";
        $q = mysql_query($sql);
        return mysql_fetch_assoc($q);
    }

    public function get_current_user() {
        if (empty($_SESSION['user_id'])) {
            return false;
        }
        return $this->get_user_by_id($_SESSION['user_id']);
    }

    public function get_all_users() {
        $sql = "SELECT * FROM users ORDER BY email ASC";
        $q = mysql_query($sql) or die(mysql_error());
        $users = array();
        while($r = mysql_fetch_assoc($q)) {
            $users[] = $r;
        }
        return $users;
    }

}
