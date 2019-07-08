<?php


namespace app\model\entities;

class Cart extends DataEntity
{
    public $id;
    public $session_id;
    public $product_id;
    public $quantity;

    public function __construct($session_id = null, $product_id = null, $quantity = null) {
        $this->session_id = $session_id;
        $this->product_id = $product_id;
        $this->quantity = $quantity;
    }
}
