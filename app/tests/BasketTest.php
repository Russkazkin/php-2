<?php


namespace app\tests;


use app\models\entities\Basket;
use PHPUnit\Framework\TestCase;


class BasketTest extends TestCase
{
    protected $fixture;

    protected function setUp() : void
    {
        $this->fixture = new Basket('55555', 5, 55);
    }

    protected function tearDown() : void
    {
        $this->fixture = NULL;
    }


    public function testObjectCreation(){
        /**
         * @var Basket $basket
         */
        $basket = $this->fixture;
        $this->assertEquals(55555, $basket->getProp('session_id'));
        $this->assertEquals(5, $basket->getProp('product_id'));
        $this->assertEquals(55, $basket->getProp('user_id'));
    }

    public function testNamespace(){
        $this->assertSame(0, strpos(get_class($this->fixture), "app\\"));
        $this->assertEquals(['models'], array_slice(explode("\\", get_class($this->fixture)), 1, 1));
        $this->assertEquals(3, substr_count(get_class($this->fixture), "\\"));
    }
}