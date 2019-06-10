<?php


namespace app\engine;


class Authentication
{
    public function cookieAuth()
    {

    }

    public function userAuth()
    {

    }

    public function passwordHash($password)
    {
        $salt = md5(uniqid(SALT, true));
        $salt = substr(strtr(base64_encode($salt), '+', '.'), 0, 22);
        return crypt($password, 'Audaegaedaec4sei' . $salt);
    }

    public function passwordCheck()
    {

    }

    public function isLoggedIn()
    {

    }
}