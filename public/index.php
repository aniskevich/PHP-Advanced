<?php
session_start();
require_once '../engine/Autoload.php';
require_once '../vendor/autoload.php';

use app\engine;
use app\engine\Render;
use app\engine\Twigrender;

spl_autoload_register([new engine\Autoload(), 'loadClass']);

if (isset($_POST['send'])) {
    $login = $_POST['login'];
    $pass = $_POST['pass'];
    if (!((new \app\model\Users())->auth($login, $pass))) {
        Die("Логин или пароль не верный!");
    } else {
        header("Location: ?c=user&a");
    }
}

if (isset($_SESSION['pages'])) {
    if (count($_SESSION['pages']) > 4) {
        array_shift($_SESSION['pages']);
    }
    $_SESSION['pages'][] = $_SERVER['REQUEST_URI'];
}

$controllerName = $_GET['c'] ?: 'user';
$actionName = $_GET['a'];

$controllerClass = "app\\controllers\\" . ucfirst($controllerName) . "Controller";
if (class_exists($controllerClass)) {
    $controller = new $controllerClass(Twigrender::getInstance());
    //$controller = new $controllerClass(Render::getInstance());
    $controller->runAction($actionName);
} else {
    echo "404";
}
