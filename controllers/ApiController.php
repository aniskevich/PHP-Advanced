<?php


namespace app\controllers;


use app\engine\App;
use app\model\entities\Reviews;

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
        $id = App::call()->session->getUserId();
        $reviews = App::call()->reviewsRepository->getWhere('user_id', $id);
        echo json_encode($reviews);
    }

    public function actionBannerReviews() {
        $reviews = App::call()->reviewsRepository->getLimit(0, 3);
        echo json_encode($reviews);
    }

    public function actionAddReview() {
        $text = App::call()->request->getParams()['text'];
        $id = App::call()->session->getUserId();
        App::call()->reviewsRepository->save(new Reviews($text));
        $reviews = App::call()->reviewsRepository->getWhere('user_id', $id);
        echo json_encode($reviews);
    }

    public function actionDeleteReview() {
        $id = App::call()->request->getParams()['id'];
        $userId = App::call()->session->getUserId();
        $review = App::call()->reviewsRepository->getOne($id);
        App::call()->reviewsRepository->delete($review);
        $reviews = App::call()->reviewsRepository->getWhere('user_id', $userId);
        echo json_encode($reviews);
    }

    public function actionDelReview() {
        $id = App::call()->request->getParams()['id'];
        $review = App::call()->reviewsRepository->getOne($id);
        App::call()->reviewsRepository->delete($review);
        $reviews = App::call()->reviewsRepository->getWhere('is_approved', 'false');
        echo json_encode($reviews);
    }

    public function actionApproveReview() {
        $id = App::call()->request->getParams()['id'];
        $review = App::call()->reviewsRepository->getOne($id);
        $review->is_approved = 'true';
        App::call()->reviewsRepository->save($review);
        $reviews = App::call()->reviewsRepository->getWhere('is_approved', 'false');
        echo json_encode($reviews);
    }

    public function actionReviewsToApprove() {
        $reviews = App::call()->reviewsRepository->getWhere('is_approved', 'false');
        echo json_encode($reviews);
    }

    public function actionGetCart() {
        $cart = App::call()->session->getCart();
        echo json_encode($cart);
    }

    public function actionGetUser() {
        $id = App::call()->session->getUserId();
        $user = App::call()->usersRepository->getWhere('id', $id)[0];
        unset($user['pass']);
        unset($user['role']);
        echo json_encode($user);
    }
}