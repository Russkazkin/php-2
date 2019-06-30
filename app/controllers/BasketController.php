<?php


namespace app\controllers;


use app\engine\App;
use app\models\entities\Basket;

class BasketController extends Controller
{
    public function actionIndex()
    {
        $this->title = "Basket";
        echo $this->render('basket/index', [
            'heading' => 'Корзина',
            'products' => App::call()->basketRepository->getBasket(session_id(), $this->user_id),
            'total' => App::call()->basketRepository->getBasketTotal(session_id(), $this->user_id)
        ]);
    }

    public function actionAdd()
    {
        $basket = new Basket(session_id(), App::call()->request->getParams()['id'], $this->user_id);
        App::call()->basketRepository->save($basket);
        $count = App::call()->basketRepository->getBasketCount(session_id(), $this->user_id);
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
        $basket = App::call()->basketRepository->getOne(App::call()->request->getParams()['id']);
        if (session_id() == $basket->getProp('session_id') || $this->user_id == $basket->getProp('user_id')) {
            App::call()->basketRepository->delete($basket);
            $count = App::call()->basketRepository->getBasketCount(session_id(),$this->user_id);
            $total = App::call()->basketRepository->getBasketTotal(session_id(), $this->user_id);
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