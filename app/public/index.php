<?php

require "../config/path.php";
require ENGINE_DIR . "Autoload.php";
use app\engine\{Autoload, Db};
use app\model\{Product, Basket, Manufacturer};

spl_autoload_register([new Autoload(), 'loadClass']);

// phpinfo();

echo "<div>Товары</div>";

/*$product1 = new Product(2);
var_dump($product1);*/
$product2 = Product::getObject(1);
var_dump($product2);
$product3 = new Product([
    'category_id' => 2,
    'manufacturer_id' => 2,
    'name' => 'Хлеб "Бородинский"',
    'description' => 'Хлеб белый, 1 сорт',
    'price' => 20.00,
]);
var_dump($product3);
echo "<div>Производители</div>";
$man1 = Manufacturer::getObject(1);
var_dump($man1);
$man2 = new Manufacturer([
    'name' => 'Сочинский Мясокомбинат',
    'description' => 'Лучшие мясные продукты из г. Сочи'
]);
var_dump($man2);
