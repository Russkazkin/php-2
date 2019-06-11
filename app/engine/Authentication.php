<?php


namespace app\engine;


use app\traits\TSingleton;

class Authentication
{
    use TSingleton;

    public function cookieAuth()
    {

    }

    public function userAuth()
    {
        $login = $_POST['login'];
        $password = $_POST['password'];
        $isAuth = false;

        $sql = "SELECT `id`, `login`, `password` FROM `user` WHERE `login` = :login";
        $user_data = Db::getInstance()->queryOne($sql, ['login' => $login]);
        if ($user_data) {
            if($this->passwordCheck($password, $user_data['password'])){
                $isAuth = true;
                $_SESSION['user'] = $user_data;
            }
        }

        if(isset($_POST['remember']) && $_POST['remember'] == 'remember'){
            setcookie("user_id", $user_data['id'], time()+86400);
            setcookie("user_hash", $user_data['password'], time()+86400);
        }

        return $isAuth;
    }

    public function passwordHash($password)
    {
        $salt = md5(uniqid(SALT, true));
        $salt = substr(strtr(base64_encode($salt), '+', '.'), 0, 22);
        return crypt($password, 'Audaegaedaec4sei' . $salt);
    }

    public function passwordCheck($password, $hash)
    {
        return $this->passwordHash($password) === $hash;
    }

    public function isLoggedIn()
    {
        return isset($_SESSION['user']);
    }
}