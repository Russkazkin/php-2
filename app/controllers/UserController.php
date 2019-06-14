<?php


namespace app\controllers;


use app\engine\Authentication;


class UserController extends Controller
{
    public function actionIndex()
    {
        $this->title = "User's Account Page";
        echo $this->render('user/index', ['userName' => $this->userName]);
    }

    public function actionLogin()
    {
        $heading = "Введите ваш логин и пароль";
        $auth = Authentication::getInstance();
        if ($auth->isLoggedIn()) {
            header('Location: /');
        }

        if($this->request->getMethod() === 'POST' && isset($this->request->getParams()['password'])){
            if(!$auth->userAuth()){
                $heading = 'Неправильный пользователь и/или пароль!';
            }else{
                header('Location: /');
            }
        }
        $this->title = 'Login';
        echo $this->render('user/login', ['heading' => $heading]);
    }

    public function actionLogout()
    {
        $auth = Authentication::getInstance();
        $auth->logout();
    }
}