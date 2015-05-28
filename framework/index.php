<?php

ini_set('display_errors', 1);
define('BASEPATH', dirname(__FILE__) . '/application/');

ob_start();
// Configs
require_once(BASEPATH . 'config/config.php');
require_once(BASEPATH . 'config/functions.php');
// Controllers
require_once(BASEPATH . 'core/MY_Controller.php');
require_once(BASEPATH . 'core/Public_Controller.php');
require_once(BASEPATH . 'core/Private_Controller.php');
// Libraries
require_once(BASEPATH . 'libraries/MY_Smarty.php');
$smarty = new MY_Smarty();
// Router Class
$default_page = "home";
$_GET['router_class'] = strtolower($_GET['router_class']);
$router_class = (isset($_GET['router_class']) && !empty($_GET['router_class']) && file_exists(BASEPATH . 'controllers/' . ucfirst(strtolower($_GET['router_class'])) . '.php')) ? $_GET['router_class'] : $default_page;
$router_class = ucfirst(strtolower($router_class));
require_once(BASEPATH . 'controllers/' . $router_class . '.php');
echo '<pre>' . print_r($router_class, true) . '</pre>';
$router_class = new $router_class();
// Router Method
$router_method = "index";
if (isset($_GET['router_method']) && !empty($_GET['router_method']) && method_exists($router_class, $_GET['router_method'])) {
    $router_method = $_GET['router_method'];
}
echo '<pre>' . print_r($router_method, true) . '</pre>';
$debug_content = ob_get_clean();
$smarty->assign('debug_contents', $debug_content);

$router_class->{$router_method}();


