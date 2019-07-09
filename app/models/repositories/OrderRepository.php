<?php


namespace app\models\repositories;


use app\models\entities\Order;
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

    public function setStatus($id, $status)
    {
        $order = $this->getOne($id);
        $order->setProp('status', $status);
        return $this->save($order);
    }

    public function getOrders()
    {
        $sql =  "SELECT o.id id_order, o.status, o.created, u.id id_user, u.name, u.email FROM orders o, user u WHERE o.user_id=u.id";
        return $this->db->queryAll($sql);
    }

    public function getOrderInfo($id)
    {
         $sql =  "SELECT o.id id_order, o.status, o.created, u.id id_user, u.name, u.email FROM orders o, user u WHERE o.user_id=u.id AND o.id=:id";
         return $this->db->queryOne($sql, ['id' => $id]);
    }

    public function getOrderTotal($id)
    {
        $sql = "SELECT SUM(p.price) as `sum` FROM basket b, product p WHERE b.product_id=p.id AND order_id = :id";
        return $this->db->queryOne($sql, ['id' => $id])['sum'];
    }
}