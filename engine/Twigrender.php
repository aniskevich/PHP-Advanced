<?php

namespace app\engine;

use app\interfaces\IRender;
use \Twig\Loader\FilesystemLoader;
use \Twig\Environment;

class Twigrender implements IRender
{
    private $twig;

    public function __construct()
    {
        $loader = new FilesystemLoader("../twig/");
        $this->twig = new Environment($loader);
    }

    public function renderTemplate($template, $params = []) {
        $fileName = "../twig/". $template . ".twig";
        if (file_exists($fileName))
            return $this->twig->render($template . ".twig", $params);
        else
            echo "404";
    }
}
