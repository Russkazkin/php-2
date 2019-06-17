<?php
/**
 * @var Authentication $auth
 */
use app\engine\Authentication;
use app\models\repositories\ProductRepository;

$this->title = "Страница отладки";


echo "<h3>CRUD test</h3>";

/**
 * @var \app\models\entities\Product $pepsi
 */
$pepsi = (new ProductRepository())->getOne(105);
var_dump($pepsi);
(new ProductRepository())->delete($pepsi);
