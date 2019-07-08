<?php


namespace app\model\repositories;


use app\model\entities\Cart;

class CartRepository extends Repository
{
    public function getCart($id) {
        $query = "SELECT * FROM Products WHERE id = :id";
        return $this->db->queryOne($query, ['id' => $id]);
    }

    public function getEntityClass() {
        return Cart::class;
    }
}