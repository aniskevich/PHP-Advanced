<?php

namespace app\controllers;
use app\engine\Request;
use app\interfaces\IRender;
use app\model\entities\Cart;
use app\model\repositories\CartRepository;

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
        $cart = (new CartRepository())->getCart($session_id);
        echo $this->render('cart', ['cart' => $cart, 'session_id' => $session_id]);
    }

    public function actionAddCart() {
        $request = new Request();
        $id = $request->getParams()['id'];
        $quantity = $request->getParams()['quantity'];
        $cart = new Cart(session_id(), $id, $quantity);
        (new CartRepository())->save($cart);
        $count = (new CartRepository())->getCountWhere('session_id', session_id());
        $response = ['result' => 1, 'count' => $count];
        header('Content-Type: application/json');
        echo json_encode($response);
    }

    public function actionDeleteCart() {
        $id = (new Request())->getParams()['id'];
        $cart = new Cart(session_id());
        $cart->id = $id;
        if (session_id() == $cart->session_id) {
            (new CartRepository())->delete($cart);
            $count = (new CartRepository())->getCountWhere('session_id', session_id());
            $response = ['result' => 1, 'count' => $count, 'id' => $id];
        } else {
            $response = ['result' => 0];
        }
        header('Content-Type: application/json');
        echo json_encode($response);
    }

}