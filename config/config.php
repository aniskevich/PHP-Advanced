<?php

use app\engine\Db;
use app\engine\Request;
use app\engine\Session;
use app\model\repositories\CartRepository;
use app\model\repositories\ProductsRepository;
use app\model\repositories\UsersRepository;
use app\model\repositories\OrdersRepository;

return [
    'root_dir' => __DIR__ . "/../",
    'templates_dir' => __DIR__ . "/../twig/",
    'controllers_namespaces' => 'app\controllers\\',
    'components' => [
        'db' => [
            'class' => Db::class,
            'driver' => 'mysql',
            'host' => 'localhost',
            'port' => 8889,
            'login' => 'user',
            'password' => 'x4kbTNyvus4XNGxa',
            'database' => 'PHP',
            'charset' => 'utf8'
        ],
        'request' => [
            'class' => Request::class
        ],
        'session' => [
            'class' => Session::class
        ],
        'cartRepository' => [
            'class' => CartRepository::class
        ],
        'productsRepository' => [
            'class' => ProductsRepository::class
        ],
        'usersRepository' => [
            'class' => UsersRepository::class
        ],
        'ordersRepository' => [
            'class' => OrdersRepository::class
        ]

    ]
];