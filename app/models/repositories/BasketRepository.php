<?php


namespace app\models\repositories;


use app\models\entities\Basket;
use app\models\Repository;

class BasketRepository extends Repository
{
    public function getBasket($session, $user = null)
    {
        $sql = "SELECT p.id id_product, b.id id_basket, p.name, p.description, p.price, p.img FROM basket b,product p WHERE (b.product_id=p.id AND session_id = :session)";
        if ($user){
            $sql .= " OR (b.product_id=p.id AND user_id = :user)";
        }
        return $this->db->queryAll($sql, [
            'session' => $session,
            'user' => $user
        ]);
    }

    public function getBasketTotal($session, $user = null)
    {
        $sql = "SELECT SUM(p.price) as `sum` FROM basket b, product p WHERE b.product_id=p.id AND session_id = :session";
        if ($user){
            $sql .= " OR (b.product_id=p.id AND user_id = :user)";
        }
        return $this->db->queryOne($sql, [
            'session' => $session,
            'user' => $user
        ])['sum'];
    }

    public function getBasketCount($session, $user = null)
    {
        $sql = "SELECT count(*) as count FROM basket WHERE session_id = :session OR user_id = :user";
        return $this->db->queryOne($sql, [
            'session' => $session,
            'user' => $user
        ])['count'];
    }

    public function getEntityClass()
    {
        return Basket::class;
    }

    public function getTableName() {
        return 'basket';
    }

}