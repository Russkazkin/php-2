<?php


namespace app\controllers;


use app\engine\App;
use app\models\entities\Order;

class OrderController extends Controller
{
    public function actionCreate()
    {
        $this->title = "Order confirmation";
        if($this->session->getProp('order_status') === null){
            $order = new Order($this->user_id,1);
            $baskets = App::call()->basketRepository->getBasket(session_id(), $this->user_id);
            App::call()->orderRepository->save($order);
            $order_id = $order->getProp('id');
            $this->session->setProp('order_status', 1);
            $this->session->setProp('order_id', $order_id);
            foreach ($baskets as $basket) {
                $item = App::call()->basketRepository->getOne($basket['id_basket']);
                $item->setProp('order_id', $order_id);
                App::call()->basketRepository->save($item);
            }
        }
        echo $this->render('order/create', [
            'heading' => 'Подтверждение заказа',
            'products' => App::call()->basketRepository->getOrderContent(App::call()->session->getProp('order_id')),
            'total' => App::call()->basketRepository->getBasketTotal(session_id(), $this->user_id),
            'order_id' => $this->session->getProp('order_id')
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