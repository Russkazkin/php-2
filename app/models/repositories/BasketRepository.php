<?php


namespace app\models\repositories;


use app\models\entities\Basket;
use app\models\Repository;

class BasketRepository extends Repository
{
    public function getBasket($session, $user = null)
    {
        $sql = "SELECT p.id id_product, b.id id_basket, p.name, p.description, p.price, p.img FROM basket b,product p WHERE (b.product_id=p.id AND session_id=:session)";
        $params = ['session' => $session];
        if ($user){
            $sql .= " OR (b.product_id=p.id AND user_id=:user)";
            $params['user'] = $user;
        }
        return $this->db->queryAll($sql, $params);
    }

    public function getBasketTotal($session, $user = null)
    {
        $sql = "SELECT SUM(p.price) as `sum` FROM basket b, product p WHERE b.product_id=p.id AND session_id = :session";
        $params = ['session' => $session];
        if ($user){
            $sql .= " OR (b.product_id=p.id AND user_id = :user)";
            $params['user'] = $user;
        }
        return $this->db->queryOne($sql, $params)['sum'];
    }

    public function getBasketCount($session, $user = null)
    {
        $sql = "SELECT count(*) as count FROM basket WHERE session_id = :session";
        $params = ['session' => $session];
        if ($user){
            $sql .= " OR user_id = :user";
            $params['user'] = $user;
        }
        return $this->db->queryOne($sql, $params)['count'];
    }

    public function getEntityClass()
    {
        return Basket::class;
    }

    public function getTableName() {
        return 'basket';
    }

}