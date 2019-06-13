<?php


namespace app\controllers;


class BasketController extends Controller
{
    public function actionIndex()
    {
        $this->title = "Basket";
        $this->basketCount = 5;
        echo $this->render('basket/index', []);
    }
}