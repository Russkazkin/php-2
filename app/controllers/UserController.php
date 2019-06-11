<?php


namespace app\controllers;


use app\engine\Authentication;


class UserController extends Controller
{
    public function actionIndex()
    {

    }
    /**
     * @var Authentication $auth
     */
    public function actionLogin()
    {
        $heading = "Введите ваш логин и пароль";
        $auth = Authentication::getInstance();
        if ($auth->isLoggedIn()) {
            header('Location: /');
        }

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
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
        unset($_SESSION['user']);
        session_destroy();
        header('Location: /');
    }
}