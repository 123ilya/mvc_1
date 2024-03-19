<?php

namespace app\core\form;

use app\core\Model;

class Form
{
    public static function begin(string $action, string $method)
    {
        return \sprintf('<form action="%s" method="%s">', $action, $method);
    }

    public static function end()
    {
        return '</form>';
    }

    public function field(Model $model, $attribute)
    {
        return new Field($model, $attribute);
    }
}
