<?php

require_once '../engine/Autoload.php';

use app\engine;
use app\model\Products;
use app\model\Users;

spl_autoload_register([new engine\Autoload(), 'loadClass']);

//$product = new Products("Jeans", null, "Jeans", "Red", "M", 250, "product6.jpg", "Jeans description");
//$product2 = new Products("Jeans", "Men", "Jeans", "Blue", "XXL", 250, "product7.jpg", "Jeans description");

//var_dump($product);
//var_dump($product->getOne(2));

//$user = new Users("vasya", "pupkin");
//$user->insert();
//var_dump($user->getOne(3));

//var_dump($product->getWhere("name", "Coat"));

//$product->insert();
//$product2->insert();

//var_dump($product);
//var_dump($product2);


//$product->delete();
//var_dump($product);

//$product = (new Products())->buildFromDb(16);
//$product2 = (new Products())->buildFromDb(12);
//var_dump($product);
//var_dump($product2);


//$product = (new Products())->buildFromDb(10);
//$product2 = (new Products())->buildFromDb(12);
//$product->delete();
//$product2->delete();

//$user = (new Users())->buildFromDb(1);
//var_dump($user);

//$product = (new Products())->buildFromDb(16);
//$product->category = "MEN";
//$product->price = 400;
//$product->update();

//$user = (new Users())->buildFromDb(1);
//$user->username = "Vanya";
//$user->update();