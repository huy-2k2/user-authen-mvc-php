<?php
require_once 'controllers/base_controller.php';
require_once 'lib/permission_lib.php';
class PageController extends BaseController
{
    function main()
    {
        check_was_sign_in();
        $this->render('home', []);
    }
    function error()
    {
        $this->render('error', []);
    }
}
