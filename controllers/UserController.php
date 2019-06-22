<?php


namespace app\controllers;


use app\engine\Request;
use app\model\repositories\UsersRepository;

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

    public function actionLogin() {
        $request = new Request();

        if (isset($request->getParams()['send'])) {
            $login = $request->getParams()['login'];
            $pass = $request->getParams()['pass'];
            if (!((new UsersRepository())->auth($login, $pass))) {
                Die("Логин или пароль не верный!");
            } else {
                header("Location: /user/");
            }
        }

    }

    public function actionLogout() {
        session_regenerate_id();
        session_destroy();
        header("Location: /user/");
        exit();
    }

    public function actionCabinet() {
        echo $this->render('cabinet');
    }
}