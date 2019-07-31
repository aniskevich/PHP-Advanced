<?php

namespace app\engine;

class Autoload
{
    public function loadClass($className)
    {
        try {
            $fileName = "../{$className}.php";
            $fileName = strtr($fileName, ['app\\'=>'', '\\'=>'/']);
            if (file_exists($fileName)) {
                require_once $fileName;
            }
            else throw new \Exception( "Такой класс еще не создан!", 404);
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }
}