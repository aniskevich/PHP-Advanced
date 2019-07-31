<?php


namespace app\engine;


class Session
{

    public function __construct()
    {
        if (!isset($_SESSION['login'])) {
            $_SESSION['login'] = 'guest';
            $_SESSION['userId'] = null;
            $_SESSION['admin'] = false;
            $_SESSION['cart'] = [];
        }

    }

    public function init($login, $userId, $role) {
        $_SESSION['login'] = $login;
        $_SESSION['userId'] = $userId;
        $_SESSION['cart'] = [];
        if ($role === 'admin')
            $_SESSION['admin'] = true;
        else
            $_SESSION['admin'] = false;
    }

    public function setCart($productId, $quantity) {
        foreach ($_SESSION['cart'] as $key=>$item) {
            if (key($item) == $productId) {
                $_SESSION['cart'][$key][key($item)] = current($_SESSION['cart'][$key]) + (int)$quantity;
                return true;
            }
            else continue;
        }
        $_SESSION['cart'][] = [$productId => (int)$quantity];
    }

    public function unsetCart($productId) {
        foreach ($_SESSION['cart'] as $key=>$item) {
            if (key($item) == $productId) {
                unset($_SESSION['cart'][$key]);
                return true;
            }
            else continue;
        }
    }

    public function clearCart() {
        $_SESSION['cart'] = [];
    }

    /**
     * @return mixed
     */
    public function getLogin()
    {
        return $_SESSION['login'];
    }

    /**
     * @return mixed
     */
    public function getUserId()
    {
        return $_SESSION['userId'];
    }

    public function isAdmin() {
        return $_SESSION['admin'];
    }

    /**
     * @return array
     */
    public function getCart()
    {
        $cart = [];
        foreach ($_SESSION['cart'] as $prod) {
            $product = App::call()->cartRepository->getCart(key($prod));
            $product['quantity'] = current($prod);
            $cart[] = $product;
        }
        return $cart;
    }

    /**
     * @return mixed
     */
    public function getCount() {
        if (!is_null($_SESSION['cart'])) {
        $counter = 0;
            foreach($_SESSION['cart'] as $product) {
                $counter += current($product);
            }
        return $counter;
        }
        else return 0;
    }

}