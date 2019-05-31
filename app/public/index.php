<?php

require "../config/path.php";
require ENGINE_DIR . "Autoload.php";
use engine\{Autoload, Db};
use model\Product;

spl_autoload_register([new Autoload(), 'loadClass']);

$test = new Product(new Db());

var_dump($test instanceof Product);