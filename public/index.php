<?php
session_start();
//var_dump($_SESSION);
require_once '../vendor/autoload.php';

use app\engine\App;

$config = include __DIR__ . "/../config/config.php";

try {
    App::call()->run($config);
    //var_dump(App::call());
    //var_dump($_SESSION);
} catch (Exception $e) {
    echo $e->getMessage();
}

