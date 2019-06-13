<?php


namespace app\controllers;


use app\models\Basket;

class BasketController extends Controller
{
    public function actionIndex()
    {
        $this->title = "Basket";
        echo $this->render('basket/index', [
            'heading' => 'Корзина',
            'products' => Basket::getBasket(session_id())
        ]);
    }

    public function actionAdd()
    {
        $id = $_POST['id'];
        (new Basket(session_id(), $id))->save();
        $count = Basket::getCountWhere('session_id', session_id());
        $response = [
            'result' => 1,
            'count' => $count,
        ];
        header('Content-Type: application/json');
        echo json_encode($response);
    }
}