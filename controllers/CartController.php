<?php

namespace app\controllers;
use app\engine\Request;
use app\interfaces\IRender;
use app\model\Cart;

class CartController extends Controller
{
    protected $defaultAction = 'cart';
    private $session_id;

    public function __construct(IRender $renderer)
    {
        parent::__construct($renderer);
        $this->session_id = session_id();
    }

    public function actionCart() {
        $session_id = $this->session_id;
        $cart = (new Cart($session_id))->getCart();
        echo $this->render('cart', ['cart' => $cart, 'session_id' => $session_id]);
    }

    public function actionAddCart() {
        $request = new Request();
        $id = $request->getParams()['id'];
        $quantity = $request->getParams()['quantity'];
        $cart = new Cart(session_id(), $id, $quantity);
        $cart->save();
        $count = $cart->getCountWhere('session_id', session_id());
        $response = ['result' => 1, 'count' => $count];
        header('Content-Type: application/json');
        echo json_encode($response);
    }

    public function actionDeleteCart() {
        $request = new Request();
        $id = $request->getParams()['id'];
        $cart = new Cart(session_id());
        $cart->id = $id;
        $cart->delete();
        $count = $cart->getCountWhere('session_id', session_id());
        $response = ['result' => 1, 'count' => $count, 'id' => $id];
        header('Content-Type: application/json');
        echo json_encode($response);
    }

}