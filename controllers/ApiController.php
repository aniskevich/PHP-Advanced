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

    public function actionProduct() {
        $id = App::call()->request->getParams()['id'];
        try {
            $product = App::call()->productsRepository->getOne($id);
            if (!$product)
                throw new \Exception('Твои бы шаловливые ручки да картошку окучивать', 404);
            else
                echo json_encode($product);
        } catch(\Exception $e) {
            echo $e->getMessage();
        }

    }

    public function actionReviews() {
        $reviews = [
            [
                "user_id" => 2,
                "user_name" => "User Test",
                "user_avatar" => "/images/user.jpg",
                "text" => "sgsdgsdg",
                "isApproved" => true,
                "id" => 5
            ],
            [
                "user_id" => 1,
                "user_name" => "NATASHA",
                "user_avatar" => "/images/user.jpg",
                "text" => "Отзыв !!! Привет, мне все понравилось",
                "isApproved" => true,
                "id" => 6
            ],
            [
                "user_id" => 3,
                "user_name" => "User",
                "user_avatar" => "/images/user.jpg",
                "text" => "!!!!",
                "isApproved" => true,
                "id" => 7
            ]
        ];
        echo json_encode($reviews);
    }

    public function actionGetCart() {
        $cart = App::call()->session->getCart();
        echo json_encode($cart);
    }
}