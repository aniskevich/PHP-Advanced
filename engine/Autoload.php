<?php

namespace app\engine;

class Autoload
{
    public function loadClass($className)
    {
        $fileName = "../{$className}.php";
        $fileName = strtr($fileName, ['app\\'=>'', '\\'=>'/']);
        if (file_exists($fileName)) {
            require_once $fileName;
        }
        else echo "Такой класс еще не создан!";
    }
}