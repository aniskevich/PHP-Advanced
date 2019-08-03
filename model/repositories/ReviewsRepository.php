<?php


namespace app\model\repositories;


use app\model\entities\Reviews;

class ReviewsRepository extends Repository
{
    public function getEntityClass() {
        return Reviews::class;
    }
}