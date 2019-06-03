<?php

require "../config/path.php";
require ENGINE_DIR . "Autoload.php";
use app\engine\{Autoload, Db};
use app\model\{Product, Basket, Manufacturer};

spl_autoload_register([new Autoload(), 'loadClass']);

// phpinfo();
echo "<div>Товары</div>";
$test = new Product(2);

$products = $test->getAll();
//var_dump($products);
$kefir = new Product(2);
var_dump($kefir);
echo "<div>Производители</div>";
$man = Manufacturer::getObject(1);
var_dump($man);