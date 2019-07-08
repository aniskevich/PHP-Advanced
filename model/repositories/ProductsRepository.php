<?php


namespace app\model\repositories;


use app\model\entities\Products;

class ProductsRepository extends Repository
{
    public function getEntityClass() {
        return Products::class;
    }
}