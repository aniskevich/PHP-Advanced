<?php


namespace app\controllers;


class UserController extends Controller
{
    private function isAuth() {
        return isset($_SESSION['login']) ? true : false;
    }

    private function getName() {
        return $this->isAuth() ? $_SESSION['login'] : "Guest";
    }

    public function actionAuth() {
        if (!$this->isAuth())
            echo $this->render('auth');
        else
            echo $this->render('index', ['name' => $this->getName()]);
    }

    public function actionLogout() {
        //сюда можно дописать сохранение массива посещенных страниц в БД
        session_destroy();
        header("Location: ?c=user&a");
        exit();
    }

    public function actionCabinet() {
        echo $this->render('cabinet', ['pages' => $_SESSION['pages']]);
    }
}