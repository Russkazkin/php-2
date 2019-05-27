<?php

require_once 'promotion.php';

$promo1 = new Promotion('Акция', 'Только в июне: новая акция!', '10-06-2019', '20-06-2019');
$promo2 = new Promotion('Ежегодная акция', 'Описание ежегодной акции');
var_dump($promo1);
var_dump($promo2);
$promo2->getPromotionInfo(true);
print_r($promo2->getPromotionInfo());

