<?php

/*
DROP TABLE IF EXISTS `jbl_options`;
CREATE TABLE IF NOT EXISTS `jbl_options` (
  `option_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(60) NOT NULL,
  `value` longtext NOT NULL,
  PRIMARY KEY (`option_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Contenu de la table `jbl_options`
--

INSERT INTO `jbl_options` (`option_id`, `name`, `value`) VALUES
(1, 'site_name', 'Le nom de mon site'),
(2, 'date_format', '%e %B %Y'),
(3, 'datetime_format', '%e %B %Y à %H:%M'),
(4, 'datemonth_format', '%B %Y'),
(5, 'base_url', 'http://domain.tld/'),
(6, 'site_in_maintenance', '0');
 */

class Options_model extends MY_Model {

    protected $table = 'options';
    protected $id = "option_id";
    protected $fields = array(
        'name',
        'value',
    );

    public function __construct() {
        // Call the Model constructor
        parent::__construct();
    }

    public function get_options() {
        return parent::get();
    }

    public function update_by_name($options) {
        $ret = TRUE;
        foreach ($options AS $k => $v) {
            if (!$this->db->update($this->table, array('value' => $v), array('name' => $k))) {
                $ret = FALSE;
            }
        }
        return $ret;
    }

    public function update_one($name, $value) {
        return $this->db->update($this->table, array('value' => $value), array('name' => $name));
    }

}
