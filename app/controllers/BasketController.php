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
        $request = new Request();
        $id = $request->getParams()['id'];
        (new Basket(session_id(), $id))->save();
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
        $request = new Request();
        $id = $request->getParams()['id'];
        $basket = Basket::getOne($id);
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