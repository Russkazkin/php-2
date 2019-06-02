<?php

require "../config/path.php";
require ENGINE_DIR . "Autoload.php";
use app\engine\{Autoload, Db};
use app\model\{Product, Basket};

spl_autoload_register([new Autoload(), 'loadClass']);

// phpinfo();

$test = new Product();

$products = $test->getAll();
var_dump($products);