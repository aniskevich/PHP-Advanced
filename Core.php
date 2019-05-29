<?php

    // Шаблон

    class Core {
        protected $id;
        protected $link;
        protected $name;

        public function __construct($id, $link, $name) {  
            $this->id = $id;
            $this->link = $link;
            $this->name = $name;
        }

        public function render() {
            include get_class($this).'.php';
        }
    }

    // Карточка продукта в каталоге

    class ProductCard extends Core {
        protected $price;

        public function __construct($id, $link, $name, $price) {
            $this->price = $price;
            parent::__construct($id, $link, $name);
        }
    }

    // Карточка продукта для модального окна

    class ProductDetail extends ProductCard {
        protected $color;
        protected $size;
        protected $about;

        public function __construct($id, $link, $name, $price, $color, $size, $about) {
            $this->color = $color;
            $this->size = $size;
            $this->about = $about;
            parent::__construct($id, $link, $name, $price);
        }

        public function addToCart($id, $connect) {
            addToCart($id, $connect);
        }
    }

    // Карточка продукта в корзине

    class CartProduct extends ProductDetail {
        protected $quantity;

        public function __construct($id, $link, $name, $price, $color, $size, $about, $quantity) {
            $this->quantity = $quantity;
            parent::__construct($id, $link, $name, $price, $color, $size, $about);
        }

        private function increaseQuantity() {

        }
        
        private function decreaseQuantity() {

        }

        private function deleteFromCart() {

        }
    }

    // Карточка отзыва

    class Review extends Core {
        protected $text;
        protected $date;

        public function __construct($id, $link, $name, $text, $date) {
            $this->text = $text;
            $this->date = $date;
            parent::__construct($id, $link, $name);
        }

        private function approveReview() {

        }

        private function deleteReview() {

        }
    }