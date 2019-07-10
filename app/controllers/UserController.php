<?php


namespace app\controllers;


use app\engine\App;

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

    public function actionHash()
    {
        echo App::call()->authentication->passwordHash('admin');
    }

    public function actionClear()
    {
        // Удаляем все переменные сессии.
        $_SESSION = array();

// Если требуется уничтожить сессию, также необходимо удалить сессионные cookie.
// Замечание: Это уничтожит сессию, а не только данные сессии!
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
                $params["path"], $params["domain"],
                $params["secure"], $params["httponly"]
            );
        }

// Наконец, уничтожаем сессию.
        session_destroy();
        var_dump($_SESSION);
    }
}