<?php


namespace app\controllers;


use app\engine\App;
use app\models\entities\Order;

class OrderController extends Controller
{
    public function actionCreate()
    {
        $order = new Order($this->user_id,0);
        var_dump($order);
        App::call()->orderRepository->save($order);
    }
}