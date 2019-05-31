<?php

require "../config/path.php";
require ENGINE_DIR . "Autoload.php";
use engine\{Autoload, Db};
use model\{Product, Basket};

spl_autoload_register([new Autoload(), 'loadClass']);
$db = new Db();
$test = new Product($db);

var_dump($test instanceof Product);

$basket = new Basket($db);
echo $basket->getTableName();