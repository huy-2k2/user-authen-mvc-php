<?php
require_once 'lib/url_lib.php';
$controllers = [
    'page' => ['main'],
    'authen' => ['main' /* sign_in*/, 'sign_up', 'sign_out', 'reset_password', 'change_password', 'active', 'active_reset', 'reset_end'],
];

if (!array_key_exists($controller, $controllers) || !in_array($action, $controllers[$controller])) {
    echo $controller, $action;
    $controller = 'page';
    $action = 'error';
}

require_once get_controller_file_name($controller);
$class_name = get_controller_class_name($controller);
$controller = new $class_name($controller);
$controller->$action();
