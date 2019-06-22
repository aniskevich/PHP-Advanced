<?php


namespace app\model\repositories;


class CartRepository extends Repository
{
    public function getCart($session) {
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
                    WHERE cart.session_id = :session";
        return $this->db->queryAll($query, ['session' => $session]);
    }
}