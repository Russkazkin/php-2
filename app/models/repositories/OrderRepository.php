<?php


namespace app\models\repositories;


use app\models\Order;
use app\models\Repository;

class OrderRepository extends Repository
{

    public function getTableName()
    {
        return 'orders';
    }

    public function getEntityClass()
    {
        return Order::class;
    }
}