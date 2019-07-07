<?php


namespace app\controllers;


use app\engine\App;
use app\models\entities\Order;

class OrderController extends Controller
{
    public function actionCreate()
    {
        $this->title = "Order confirmation";
        if($this->session->getProp('status') === null){
            $order = new Order($this->user_id,0);
            App::call()->orderRepository->save($order);
            $this->session->setProp('status', 0);
        }
        echo $this->render('order/index', [
            'heading' => 'Подтверждение заказа',
            'products' => App::call()->basketRepository->getBasket(session_id(), $this->user_id),
            'total' => App::call()->basketRepository->getBasketTotal(session_id(), $this->user_id)
        ]);
    }

    public function actionConfirm()
    {
        $response = [
            'result' => 1,
            'test' => 'php side sends response'
        ];
        header('Content-Type: application/json');
        echo json_encode($response);
    }
}