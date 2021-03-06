<?php

namespace app\controllers;

use app\engine\App;

class CartController extends Controller
{
    protected $defaultAction = 'cart';

    public function actionCart() {
        $cart = App::call()->session->getCart();
        echo $this->render('cart', ['cart' => $cart, 'session_id' => session_id()]);
    }

    public function actionAddCart() {
        $id = App::call()->request->getParams()['id'];
        $quantity = App::call()->request->getParams()['quantity'];
        App::call()->session->setCart($id, $quantity);
        $count = App::call()->session->getCount();
        $response = ['result' => 1, 'count' => $count];
        header('Content-Type: application/json');
        echo json_encode($response);
    }

    public function actionDeleteCart() {
        $id = App::call()->request->getParams()['id'];
        App::call()->session->unsetCart($id);
        $count = App::call()->session->getCount();
        $response = ['result' => 1, 'count' => $count, 'id' => $id];
        header('Content-Type: application/json');
        echo json_encode($response);
    }

    public function actionGetCart() {
        $id = App::call()->request->getParams()['id'];
        $order = App::call()->ordersRepository->getWhere('id', $id);
        $cart = App::call()->cartRepository->getWhere('session_id', $order[0]['session_id']);
        $sum = 0;
        foreach ($cart as $key => $product) {
            $cart[$key]['product'] = App::call()->cartRepository->getCart($product['product_id']);
            $cart[$key]['product']['quantity'] = $product['quantity'];
            $cart[$key]['product']['subtotal'] = $cart[$key]['product']['quantity'] * $cart[$key]['product']['price'];
            $sum += $cart[$key]['product']['subtotal'];
            unset($cart[$key]['product_id']);
            unset($cart[$key]['quantity']);

        }
        $response = ['cart' => $cart, 'sum' => $sum];
        header('Content-Type: application/json');
        echo json_encode($response);
    }

}
