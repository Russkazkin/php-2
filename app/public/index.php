<?php

require "../config/path.php";
require ENGINE_DIR . "Autoload.php";
use app\engine\{Autoload, Db};
use app\model\{Product, Basket, Manufacturer, Category};

spl_autoload_register([new Autoload(), 'loadClass']);

// phpinfo();

echo "<h3>Product</h3>";

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
$product3->insert();

var_dump($product3);
echo "<h3>Manufacturer</h3>";
$man1 = Manufacturer::getObject(1);
var_dump($man1);
$man2 = new Manufacturer([
    'name' => 'Сочинский Мясокомбинат',
    'description' => 'Лучшие мясные продукты из г. Сочи'
]);
$man2->insert();
$man2->delete();
echo "<h3>Category</h3>";
$cat1 = Category::getObject(1);
var_dump($cat1);

$product3->delete();
