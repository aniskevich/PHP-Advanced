<?php

namespace app\controllers;

use app\engine\Request;
use app\model\repositories\ProductsRepository;

class ProductController extends Controller
{
    public function actionCatalog() {
        $limit = (new Request())->getParams()['p'];
        $products = (new ProductsRepository())->getLimit(0, $limit *3);
        echo $this->render('catalog', ['products' => $products, 'page' => $limit]);
    }

    public function actionCard() {
        $id = (new Request())->getParams()['id'];
        try {
            $product = (new ProductsRepository())->buildFromDb($id);
            if (!$product)
                throw new \Exception('Твои бы шаловливые ручки да картошку окучивать', 404);
            else
                echo $this->render('card', ['product' => $product]);
        } catch(\Exception $e) {
            echo $e->getMessage();
        }

    }
}