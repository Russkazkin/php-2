<?php


namespace app\controllers;


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
        if ($this->authentication->isLoggedIn()) {
            header('Location: /');
        }

        if($this->request->getMethod() === 'POST' && isset($this->request->getParams()['password'])){
            if(!$this->authentication->userAuth()){
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
        $this->authentication->logout();
    }
}