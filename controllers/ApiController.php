<?php


namespace app\controllers;


use app\engine\App;

class ApiController extends Controller
{
    public function actionCatalog() {
        $limit = 4;
        $products = App::call()->productsRepository->getLimit(0, $limit);
        echo json_encode($products);
    }
}