<?php
// load helper functions
require_once 'functions.php';

// register class autoloader function
spl_autoload_register('Helper\autoLoadClass');

// set exception handler
set_exception_handler(['ErrorHandler', 'handle']);

$route    = Helper\getRoute(0);
$route_id = Helper\getRoute(1);

// navigate to /index when no route given
if ($route === false) {
    header('Location: /index'); exit;
}

// load database class
$db = new Database();

// load controller 
if (!method_exists((new Survey), str_replace('404', '_404', $route))) {
    throw new Exception("Controller has no method '$route'");
}
$data = call_user_func([(new Survey), str_replace('404', '_404', $route)], $route_id);

try {
    // generate the view by route with data
    View::load($route, $data);
} catch (Exception $e) {
    // 404 page
    header($_SERVER['SERVER_PROTOCOL'] . ' 404 Not Found'); 
    View::load('404');
}
