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
    }
}