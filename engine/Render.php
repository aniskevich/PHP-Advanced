<?php

namespace app\engine;

use app\interfaces\IRender;

class Render implements IRender
{
    private static $instance = null;
    public static $count;

    public static function getInstance() {
        if (static::$instance == null) {
            static::$instance = new static();
            static::$count++;
        }
        return static::$instance;
    }

    public function renderTemplate($template, $params = []) {
        ob_start();
        extract($params);
        $fileName = "../views/{$template}.php";
        try {
            if (file_exists($fileName)) {
                include $fileName;
            } else {
                throw new \Exception('Нет у нас такой страницы', 404);
            }
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
        return ob_get_clean();
    }
}