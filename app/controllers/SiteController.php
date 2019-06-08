<?php


namespace app\controllers;


class SiteController extends Controller
{
    public function actionIndex()
    {
        echo $this->render('index', ['heading' => 'Главная страница', 'title' => 'Главная']);
    }

    public function actionDebug()
    {
        echo $this->render('debug');
    }
}