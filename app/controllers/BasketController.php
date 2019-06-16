<?php


namespace app\controllers;


use app\engine\Authentication;
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
            'products' => Basket::getBasket(session_id(), Authentication::getInstance()->getUserId()),
            'total' => Basket::getBasketTotal(session_id(), Authentication::getInstance()->getUserId())
        ]);
    }

    public function actionAdd()
    {
        (new Basket(session_id(), (new Request())->getParams()['id'], Authentication::getInstance()->getUserId()))->save();
        $count = Basket::getBasketCount(session_id(), Authentication::getInstance()->getUserId());
        $response = [
            'result' => 1,
            'count' => $count,
        ];
        header('Content-Type: application/json');
        echo json_encode($response);
    }

    public function actionDelete()
    {
        /**
         * @var Basket $basket
         */
        $basket = Basket::getOne((new Request())->getParams()['id']);
        if (session_id() == $basket->getProp('session_id') || Authentication::getInstance()->getUserId() ==
            $basket->getProp('user_id')) {
            $basket->delete();
            $count = Basket::getBasketCount(session_id(), Authentication::getInstance()->getUserId());
            $total = Basket::getBasketTotal(session_id(), Authentication::getInstance()->getUserId());
            $response = [
                'result' => 1,
                'count' => $count,
                'total' => $total
            ];
            header('Content-Type: application/json');
            echo json_encode($response);
        } else {
            echo json_encode(['response' => 0]);
        }
    }
}