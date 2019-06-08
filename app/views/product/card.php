<?php
/**
 * @var \app\models\Product $product
 */
$this->title = $product->getProp('name');
?>
<h1><?=$product->getProp('name')?></h1>
<img src="/img/<?=$product->getProp('img')?>" alt="<?=$product->getProp('name')?> img">
<p class="item-description">Описание: <?=$product->getProp('description')?></p>
<p class="item-price">Цена: <?=$product->getProp('price')?> рублей</p>
<button type="button" class="btn btn-success">В корзину</button>