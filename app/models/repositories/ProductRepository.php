<?php


namespace app\models\repositories;


use app\models\entities\Product;
use app\models\Repository;

class ProductRepository extends Repository
{
    public function getEntityClass()
    {
        return Product::class;
    }

    public function getTableName() {
        return 'product';
    }

}