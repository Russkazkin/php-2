<?php


namespace app\controllers;


class SiteController extends Controller
{
    public function actionIndex()
    {
        $this->title = 'Главная';
        echo $this->render('index', ['heading' => 'Главная страница']);
    }

    public function actionDebug()
    {
        $this->title = 'Страница дебага';
        echo $this->render('debug');
    }
}