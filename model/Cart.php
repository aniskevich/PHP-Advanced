<?php


namespace app\model;

use app\interfaces\ICart;

class Cart extends DbModel implements ICart
{
    public $id;
    public $session_id;
    public $product_id;
    public $quantity;

    public function __construct($session_id, $product_id = null, $quantity = null) {
        parent::__construct();
        $this->session_id = $session_id;
        $this->product_id = $product_id;
        $this->quantity = $quantity;
    }

    public function getCart() {
        $query = "SELECT 
                    cart.quantity, 
                    cart.id as cart_id,
                    Products.id, 
                    Products.name, 
                    Products.category, 
                    Products.type, 
                    Products.price, 
                    Products.link, 
                    Products.color, 
                    Products.size,
                    Products.about FROM cart 
                    INNER JOIN Products 
                    ON cart.product_id = Products.id 
                    WHERE cart.session_id = '{$this->session_id}'";
        return $this->db->queryAll($query);
    }
}
