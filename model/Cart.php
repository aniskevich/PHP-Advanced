<?php


namespace app\model;

use app\interfaces\ICart;

class Cart extends Model implements ICart
{
    protected $productsAmount;
    protected $sum;
    protected $userId;
    protected $products = [];

    public function add($id) {
        // INSERT || UPDATE
        die;
    }

    public function removeOne($id) {
        // UPDATE || DELETE
        die;
    }

    public function removeAll($id) {
        // DELETE
        die;
    }

    protected function getSum() {
        die;
    }
}
