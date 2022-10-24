<?php
function get_controller_file_name($controller)
{
    //example file: controller/page_controller.php
    return 'controllers/' . $controller . '_controller.php';
}

function get_controller_class_name($controller)
{
    //example class name: PageController
    return str_replace('_', '', ucwords($controller, '_')) . 'Controller';
}

function get_view_file_name($folder, $file)
{
    return 'views/' . $folder . '/' . $file . '.php';
}
