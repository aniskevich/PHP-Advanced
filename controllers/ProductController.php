<?php

namespace app\controllers;

use app\model\Products;

class ProductController extends Controller
{
    public function actionCatalog() {
        $limit = $_GET['p'];
        $products = (new Products())->getLimit(0, $limit *3);
        echo $this->render('catalog', ['products' => $products, 'page' => $limit]);
    }

    public function actionCard() {
        $idx = $_GET['id'];
        $product = (new Products())->buildFromDb($idx);
        echo $this->render('card', ['product' => $product]);
    }
}