<?php


namespace app\controllers;


use app\engine\Request;
use app\models\Basket;
use app\models\Product;

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
        (new Basket(session_id(), (new Request())->getParams()['id']))->save();
        $count = Basket::getCountWhere('session_id', session_id());
        $response = [
            'result' => 1,
            'count' => $count,
        ];
        header('Content-Type: application/json');
        echo json_encode($response);
    }

    public function actionDelete()
    {
        $basket = Basket::getOne((new Request())->getParams()['id']);
        $basket->delete();
        $count = Basket::getCountWhere('session_id', session_id());
        $response = [
            'result' => 1,
            'count' => $count,
        ];
        header('Content-Type: application/json');
        echo json_encode($response);
    }
}