<?php


namespace app\tests;


use app\models\entities\Basket;
use PHPUnit\Framework\TestCase;


class BasketTest extends TestCase
{
    public function testObjectCreation(){
        $basket = new Basket('55555', 5, 55);
        $this->assertEquals(55555, $basket->getProp('session_id'));
        $this->assertEquals(5, $basket->getProp('product_id'));
        $this->assertEquals(55, $basket->getProp('user_id'));
    }
}