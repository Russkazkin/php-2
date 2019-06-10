<?php


namespace app\engine;


class Authentication
{
    public function cookieAuth()
    {

    }

    public function userAuth()
    {
        $login = $_POST['login'];
        $password = $_POST['password'];

        $sql = "SELECT `id`, `login`, `password` FROM `user` WHERE `login` = :login";
        $user_data = Db::getInstance()->queryOne($sql, ['login' => $login]);
        var_dump($user_data);
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