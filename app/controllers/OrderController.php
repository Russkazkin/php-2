<?php


namespace app\controllers;


use app\engine\App;
use app\models\entities\Order;

class OrderController extends Controller
{
    public function actionCreate()
    {
        $this->title = "Order confirmation";
        $order = new Order($this->user_id,0);
        App::call()->orderRepository->save($order);
        echo $this->render('order/index', [
            'heading' => 'Подтверждение заказа',
            'products' => App::call()->basketRepository->getBasket(session_id(), $this->user_id),
            'total' => App::call()->basketRepository->getBasketTotal(session_id(), $this->user_id)
        ]);
    }
}