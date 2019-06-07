<?php
/**
 * @var \app\models\Product $products
 */
?>

<h1>Каталог</h1>

<div class="products-wrap">
<?php foreach ($products as $product): ?>
    <div class="card product-item mb-4" style="width: 18rem;">
        <img src="/img/<?=$product["img"]?>" class="card-img-top" alt="<?=$product["name"]?> img">
        <div class="card-body bg-dark">
            <h5 class="card-title"><?=$product["name"]?></h5>
            <p class="card-text"><?=$product["description"]?></p>
            <p class="card-price"><?=$product["price"]?></p>
            <a href="/product/card/<?=$product["id"]?>" class="btn btn-primary">Купить</a>
        </div>
    </div>
<?php endforeach; ?>
</div>

