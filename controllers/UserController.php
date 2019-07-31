<?php


namespace app\controllers;

use app\engine\App;

class UserController extends Controller
{
    private function isAuth() {
        return  (App::call()->session->getLogin() != "guest") ? true : false;
    }

    private function getName() {
        return $this->isAuth() ? App::call()->session->getLogin() : "Guest";
    }

    public function actionAuth() {

            echo $this->render('index', ['name' => $this->getName()]);
    }

    public function actionLogin() {
        if (isset(App::call()->request->getParams()['send'])) {
            $login = App::call()->request->getParams()['login'];
            $pass = App::call()->request->getParams()['pass'];
            if (!App::call()->usersRepository->auth($login, $pass)) {
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
        $orders = App::call()->ordersRepository->getWhere('user_id', App::call()->session->getUserId());
        foreach ($orders as $key => $order) {
            $orders[$key]['sum'] =0;
            $orders[$key]['cart'] = App::call()->cartRepository->getWhere('session_id', $order['session_id']);
            foreach ($orders[$key]['cart'] as $k => $product) {
                $orders[$key]['cart'][$k] = App::call()->cartRepository->getCart($product['product_id']);
                $orders[$key]['cart'][$k]['quantity'] = $product['quantity'];
                $orders[$key]['cart'][$k]['subtotal'] = $orders[$key]['cart'][$k]['price'] * $product['quantity'];
                $orders[$key]['sum'] += $orders[$key]['cart'][$k]['subtotal'];
            }
        }
        echo $this->render('cabinet', ['orders' => $orders]);

    }

    public function actionAdmin() {
        $orders = App::call()->ordersRepository->getAll();
        echo $this->render('admin', ['orders' => $orders]);
    }
}
