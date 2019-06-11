<?php

require_once '../engine/Autoload.php';

use app\engine;

spl_autoload_register([new engine\Autoload(), 'loadClass']);

$controllerName = $_GET['c'] ?: 'product';
$actionName = $_GET['a'];

$controllerClass = "app\\controllers\\" . ucfirst($controllerName) . "Controller";
if (class_exists($controllerClass)) {
    $controller = new $controllerClass();
    $controller->runAction();
} else {
    echo "404";
}

