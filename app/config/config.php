<?php

//define("DIR_ROOT", $_SERVER['DOCUMENT_ROOT']);
//define("DS", DIRECTORY_SEPARATOR);
use app\engine\Request;
use app\models\repositories\BasketRepository;
use app\models\repositories\ProductRepository;
use app\models\repositories\UserRepository;
use app\engine\Db;

return [
    'root_dir' => __DIR__ . "/../",
    'templates_dir' => __DIR__ . "/../views/",
    'controllers_namespaces' => 'app\controllers\\',
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
        ]

    ]
];
