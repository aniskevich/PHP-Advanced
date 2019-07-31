<?php


namespace app\controllers;


use app\engine\App;
use app\model\entities\Cart;
use app\interfaces\IRender;
use app\model\entities\Orders;

class OrdersController extends Controller
{
    protected $defaultAction = 'orders';
    private $session_id;

    public function __construct(IRender $renderer)
    {
        parent::__construct($renderer);
        $this->session_id = session_id();
    }

    public function actionOrders() {
        $cart = App::call()->session->getCart();
        echo $this->render('orders', ['cart' => $cart]);
    }

    public function actionAdd() {
        $params = App::call()->request->getParams();
        $userId = App::call()->session->getUserId();
        App::call()->ordersRepository->save(new Orders($userId, $params['email'], $params['payment'], $params['address']));
        foreach (App::call()->session->getCart() as $cart) {
            App::call()->cartRepository->save(new Cart(session_id(), $cart['id'], $cart['quantity']));
        }
        App::call()->session->clearCart();
        session_regenerate_id();
        header("Location: /user/");
    }

    public function actionUpdate() {
        try {
            if (isset(App::call()->request->getParams()['select'])) {
                $order = App::call()->ordersRepository->getOne(App::call()->request->getParams()['id']);
                $order->status = App::call()->request->getParams()['select'];
                App::call()->ordersRepository->save($order);
                header("Location: /user/admin/");
            } else {
                throw new \Exception('Error!!', 404);
            }
        } catch (\Exception $e) {
            echo $e->getMessage();
        }

    }
}