<?php

namespace app\core;

class Request
{
    public function getPath()
    {
        $path = $_SERVER["REQUEST_URI"] ?? '/';
        $position = \strpos($path, '?');
        echo '<pre>';
        \var_dump($position);
        // \var_dump($path);

        echo '</pre>';
        exit;
    }

    public function getMethod()
    {
    }
}
