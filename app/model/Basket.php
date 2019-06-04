<?php


namespace app\model;


class Basket extends Model
{
    public $id;
    public $session_id;
    public $product_id;

    public function getBasket($session_id)
    {

    }
}