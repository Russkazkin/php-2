<?php

echo '<h3>Задания 1, 2, 3, 4</h3><br>';

require_once 'Promotion.php';
require_once 'Sale.php';

$promo1 = new Promotion('Акция', 'Только в июне: новая акция!', '10-06-2019', '20-06-2019');
$promo2 = new Promotion('Ежегодная акция', 'Описание ежегодной акции');
var_dump($promo1);
var_dump($promo2);
$promo1->getPromotionRender();
print_r($promo1->getPromotionArr());

$sale = new Sale(20, 'Сад и огород','Распродажа века');
$sale->getPromotionRender();

echo "Цена со скидкой: {$sale->priceDiscount(200)}<br>";
echo "Цена со скидкой: {$sale->priceDiscount(1500)}<br>";

print_r($sale->getPromotionArr());