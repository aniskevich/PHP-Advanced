<?php


namespace app\model\repositories;


use app\model\entities\Orders;

class OrdersRepository extends Repository
{
    public function getEntityClass() {
        return Orders::class;
    }
}