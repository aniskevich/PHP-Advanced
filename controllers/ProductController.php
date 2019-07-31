<?php

namespace app\controllers;

use app\engine\App;

class ProductController extends Controller
{
    public function actionCatalog() {
        $limit = App::call()->request->getParams()['p'];
        $products = App::call()->productsRepository->getLimit(0, $limit *3);
        echo $this->render('catalog', ['products' => $products, 'page' => $limit]);
    }

    public function actionCard() {
        $id = App::call()->request->getParams()['id'];
        try {
            $product = App::call()->productsRepository->getOne($id);
            if (!$product)
                throw new \Exception('Твои бы шаловливые ручки да картошку окучивать', 404);
            else
                echo $this->render('card', ['product' => $product]);
        } catch(\Exception $e) {
            echo $e->getMessage();
        }

    }
}