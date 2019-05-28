<?php

require_once 'Promotion.php';
require_once 'Sale.php';

$promo1 = new Promotion('Акция', 'Только в июне: новая акция!', '10-06-2019', '20-06-2019');
$promo2 = new Promotion('Ежегодная акция', 'Описание ежегодной акции');
var_dump($promo1);
var_dump($promo2);
$promo2->getPromotionInfo(true);
print_r($promo2->getPromotionInfo());

$sale = new Sale(20, 'Сад и огород','Распродажа века');
$sale->getPromotionInfo(true);

echo "Цена со скидкой: {$sale->priceDiscount(200)}<br> ";
echo "Цена со скидкой: {$sale->priceDiscount(1500)}<br> ";