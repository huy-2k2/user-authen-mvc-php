<?php
require_once 'lib/url_lib.php';
class BaseController
{
    protected $folder;

    function __construct($folder)
    {
        $this->folder = $folder;
    }

    function render($file, $data)
    {
        $view_file = get_view_file_name($this->folder, $file);
        ob_start();
        extract($data);
        require_once $view_file;
        $content = ob_get_clean();
        require_once 'views/layout/application.php';
    }
}
