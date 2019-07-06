<?php


namespace app\controllers;


use app\engine\App;
use app\models\entities\Order;

class OrderController extends Controller
{
    public function actionCreate()
    {
        $order = new Order(0);
        var_dump($order);
        App::call()->orderRepository->save($order);
    }
}