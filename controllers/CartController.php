<?php

namespace app\controllers;
use app\interfaces\IRender;
use app\model\Cart;
use app\model\Products;

class CartController extends Controller
{
    protected $defaultAction = 'cart';
    private $user_id;

    public function __construct(IRender $renderer)
    {
        parent::__construct($renderer);
        $this->user_id = $_SESSION['user_id'];
    }

    public function actionCart() {
        $user_id = $this->user_id;
        $cart = (new Cart($user_id))->getWhere('user_id', $user_id);
        $products = [];
        foreach ($cart as $key => $value) {
            extract($value);
            $product = (new Products())->buildFromDb($product_id);
            $product->quantity = $quantity;
            $products[] = $product;
        }
        echo $this->render('cart', ['products' => $products, 'user_id' => $user_id]);
    }
}