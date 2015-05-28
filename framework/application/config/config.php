<?php

session_start();
$connect = mysql_connect('localhost', 'pierre-roels', 'jzDmvhkf') or die(mysql_error());
mysql_select_db('joevin') or die(mysql_error());

define('BASE_URL', 'http://joevin.pierre-roels.com/framework/');
define('MY_DEBUG', preg_match('#dfngiudhç87263487362478HHHHG#', $_SERVER['HTTP_USER_AGENT']));
