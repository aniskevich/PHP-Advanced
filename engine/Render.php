<?php

namespace app\engine;

use app\interfaces\IRender;
use app\traits\Tsingletone;

class Render implements IRender
{
    use Tsingletone;

    public function renderTemplate($template, $params = []) {
        ob_start();
        extract($params);
        $fileName = "../views/{$template}.php";
        if (file_exists($fileName)) {
            include $fileName;
        } else {
            echo "404";
        }
        return ob_get_clean();
    }
}