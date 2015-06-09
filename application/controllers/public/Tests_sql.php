<?php

class Tests_sql extends MY_Controller {

    public function index() {
        $sql_query = "SHOW TABLES";

        // SELECT simple
        $sql_query = "SELECT * FROM jbl_users";

        // SELECT avec ORDER BY
        $sql_query = "SELECT * FROM jbl_users ORDER BY created DESC";
        $sql_query = "select * from jbl_users oRdEr By `created` DESC";

        // SELECT avec LIMIT & OFFSET
        $sql_query = "SELECT * FROM jbl_users LIMIT 2";
        $sql_query = "SELECT * FROM jbl_users ORDER BY created DESC LIMIT 2";
        $sql_query = "SELECT * FROM jbl_users ORDER BY created DESC LIMIT 4 OFFSET 8";

        // SELECT avec ORDER BY multi champs
        $sql_query = "SELECT * FROM jbl_users ORDER BY profession_status_id DESC, last_name ASC, first_name ASC";

        // COUNT() & GROUP BY
        $sql_query = "SELECT COUNT(*), profession_status_id FROM jbl_users GROUP BY profession_status_id";
        $sql_query = "SELECT COUNT(user_id) AS num, profession_status_id FROM jbl_users GROUP BY profession_status_id";

        // Le AS : disponible pour les champs & les tables
        $sql_query = "SELECT *, CONCAT(first_name, ' ', last_name) AS full_name FROM jbl_users AS users ORDER BY users.created DESC";

        // WHERE : chercher quelque chose
        $sql_query = "SELECT * FROM jbl_users WHERE profession_status_id != '3'";
        $sql_query = "SELECT * FROM jbl_users "
                . "WHERE profession_status_id = '1' "
                . "AND sexe = 'Masculin' "
                . "/*AND qqch = 'truc'*/";
        $sql_query = "SELECT * FROM jbl_users "
                . "WHERE profession_status_id = '2' "
                . "OR user_id < '22' "
                . "/*OR ezrfgsfdfsd = 'qsdfqsdf'*/";

//
//        $sql_query = "SELECT * FROM jbl_users"
//                . " WHERE account_status = 'validated' "
//                . " AND ((user_age > 18 AND user_age <= 29) "
//                . " OR (sexe = 'f' AND celibataire = '1' AND user_age > '8'))  ";
        // WHERE LIKE
        $user_last_name = "";
        if ($this->input->post('action') == "submit" && $this->input->post('user_last_name')) {
            $user_last_name = $this->input->post('user_last_name');
            $sql_query = "SELECT * FROM jbl_users"
                    . " WHERE user_id > 1"
                    . " AND last_name LIKE '" . ($this->input->post('user_last_name')) . "%'"
                    . " LIMIT 20";
        }



        $res = $this->db->query($sql_query)->result();

        $sql_query = "INSERT INTO jbl_users (last_name, first_name, email) VALUES('mon nom de famille', 'mon pitit prénom', 'pierre+ qsdf dsf dsqdsfqqdsfd sq')";
        
        $sql_query = "INSERT INTO jbl_users (user_id, last_name, first_name, email) "
                . "VALUES(131, 'c\'est moi le vrai possesseur du compte', 'ta mère en slip', 'ma.vrai.adresse@email.com')"
//                . " ON DUPLICATE KEY UPDATE last_name = 'Roulssse', first_name = 'Piet', email = 'piet.roulssse@gmail.com'";
                . " ON DUPLICATE KEY UPDATE last_name = VALUES(last_name), first_name = VALUES(first_name)";

        $res = $this->db->query($sql_query);
        //echo '<pre>' . print_r($this->db->insert_id(), true) . '</pre>';

        //echo '<pre>' . print_r($this->db->last_query(), true) . '</pre>';
        //echo '<pre>' . print_r($res, true) . '</pre>';

        // DELETE
//        $sql_query = "DELETE FROM jbl_users WHERE user_id = '" . $this->db->insert_id() . "'";
//        $res = $this->db->query($sql_query);
        
        // UPDATE
        $sql_query = "UPDATE jbl_users SET last_name = 'mon nouveau nom', email = 'pierre+@greenpig.be' WHERE user_id = '114'";
        $res = $this->db->query($sql_query);
        //echo '<pre>' . print_r($this->db->last_query(), true) . '</pre>';
        //echo '<pre>' . print_r($res, true) . '</pre>';
        ?>

        <form method="post" action="">
            <input type="text" name="user_last_name" value="<?php echo $user_last_name; ?>" />
            <input type="submit" name="action" value="submit" />
        </form>
        <?php
    }

}
?>