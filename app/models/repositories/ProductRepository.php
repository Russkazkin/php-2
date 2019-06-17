<?php


namespace app\models\repositories;


use app\models\entities\Product;

class ProductRepository
{
    public function getEntityClass()
    {
        return Product::class;
    }

    public function getTableName() {
        return 'product';
    }

}