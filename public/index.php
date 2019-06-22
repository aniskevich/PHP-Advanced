<?php
session_start();
//require_once '../engine/Autoload.php';
require_once '../vendor/autoload.php';

use app\engine;
use app\engine\Render;
use app\engine\Twigrender;
use app\engine\Request;

//spl_autoload_register([new engine\Autoload(), 'loadClass']);

$request = new Request();

$controllerName = $request->getControllerName() ?: 'user';
$actionName = $request->getActionName();


$controllerClass = "app\\controllers\\" . ucfirst($controllerName) . "Controller";
if (class_exists($controllerClass)) {
    $controller = new $controllerClass(new Twigrender());
    //$controller = new $controllerClass(Render::getInstance());
    $controller->runAction($actionName);
} else {
    echo "404";
}



//try {
//
//    if (!class_exists('Test'))
//        throw new \Exception("три топора ", 777);
//    else
//        $test = new Test();
//
//} catch (\Exception $e) {
//
//    echo $e->getMessage();
//    echo $e->getCode();
//}