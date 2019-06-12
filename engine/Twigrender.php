<?php

namespace app\engine;

use app\interfaces\IRender;
use app\traits\Tsingletone;
use \Twig\Loader\FilesystemLoader;
use \Twig\Environment;

class Twigrender implements IRender
{
    use Tsingletone;

    public function renderTemplate($template, $params = []) {
        ob_start();
        $fileName = "../twig/". $template . ".twig";
        if (file_exists($fileName)) {
            $loader = new FilesystemLoader("../twig/");
            $twig = new Environment($loader);
            echo $twig->render($template . ".twig", $params);
       } else {
            echo "404";
            }
        return ob_get_clean();
    }
}
