<?php

use app\model\Category;
use app\model\Manufacturer;
use app\model\Product;

echo "<h3>Product</h3>";

//$product1 = new Product(2, 1, 'Молоко топленое, полиэтиленовый пакет', 'Жирность 1.5%', 55);

/**
 * @var Product $product1
 */

$product1 = Product::getOne(101);


$product1->setProp('price', 58.90);
$product1->setProp('description', 'Жирность 3.5%');
var_dump($product1->save());

var_dump($product1);

//$product2 = Product::getOne(101);
//var_dump($product2);

/*echo "<h3>Manufacturer</h3>";
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

$product3->delete();*/