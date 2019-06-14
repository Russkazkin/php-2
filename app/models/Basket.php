<?php


namespace app\models;


use app\engine\Db;

class Basket extends DbModel
{
    public $id;
    public $session_id;
    public $product_id;
    public $user_id;

    /**
     * Basket constructor.
     * @param $session_id
     * @param $product_id
     * @param $user_id
     */
    public function __construct($session_id = null, $product_id = null, $user_id = null)
    {
        $this->session_id = $session_id;
        $this->product_id = $product_id;
        $this->user_id = $user_id;

        parent::__construct();
    }



    public static function getBasket($session, $user = null)
    {
    $sql = "SELECT p.id id_product, b.id id_basket, p.name, p.description, p.price, p.img FROM basket b,product p WHERE b.product_id=p.id AND session_id = :session";
    return Db::getInstance()->queryAll($sql, ['session' => $session]);
    }

    public static function getBasketTotal($session, $user = null)
    {
        $sql = "SELECT SUM(p.price) as `sum` FROM basket b, product p WHERE b.product_id=p.id AND session_id = :session";
        return Db::getInstance()->queryOne($sql, ['session' => $session])['sum'];
    }
}