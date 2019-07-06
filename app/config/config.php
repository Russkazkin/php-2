<?php

//define("DIR_ROOT", $_SERVER['DOCUMENT_ROOT']);
//define("DS", DIRECTORY_SEPARATOR);
use app\engine\Request;
use app\engine\Session;
use app\engine\Authentication;
use app\models\repositories\BasketRepository;
use app\models\repositories\ProductRepository;
use app\models\repositories\UserRepository;
use app\models\repositories\OrderRepository;
use app\engine\Db;

return [
    'root_dir' => __DIR__ . "/../",
    'templates_dir' => __DIR__ . "/../views/",
    'controllers_namespaces' => 'app\controllers\\',
    'salt' => 'Joon2eeshoogh1oo',
    'components' => [
        'db' => [
            'class' => Db::class,
            'driver' => 'mysql',
            'host' => 'app_db',
            'login' => 'shop',
            'password' => 'shop',
            'database' => 'shop',
            'charset' => 'utf8'
        ],
        'request' => [
            'class' => Request::class
        ],
        'session' => [
            'class' => Session::class
        ],
        'authentication' => [
            'class' => Authentication::class
        ],
        //По хорошему сделать для репозиториев отедьное простое хранилище
        //без reflection
        'basketRepository' => [
            'class' => BasketRepository::class
        ],
        'productRepository' => [
            'class' => ProductRepository::class
        ],
        'userRepository' => [
            'class' => UserRepository::class
        ],
        'orderRepository' => [
            'class' => OrderRepository::class
        ]

    ]
];
