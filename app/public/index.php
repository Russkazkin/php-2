<?php

require "../config/path.php";
require ENGINE_DIR . "Autoload.php";
use app\engine\{Autoload, Db};
use app\model\{Product, Basket};

spl_autoload_register([new Autoload(), 'loadClass']);

// phpinfo();

$test = new Product(2);

$products = $test->getAll();
//var_dump($products);
$kefir = new Product(2);
var_dump($kefir);