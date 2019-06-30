<?php


namespace app\engine;



class Authentication
{
    private $db;
    private $session;

    public function __construct()
    {
        $this->db = App::call()->db;
        $this->session = App::call()->session;
    }

    public function cookieAuth()
    {
        $isAuth = false;
        if(isset($_COOKIE['user_id']) && isset($_COOKIE['user_hash'])){
            $id = $_COOKIE['user_id'];
            $password = $_COOKIE['user_hash'];
            $sql = "SELECT `id`, `login`, `password`, `name` FROM `user` WHERE `id` = :id";
            $userData = Db::getInstance()->queryOne($sql, ['id' => $id]);

            if($userData['password'] !== $password || $userData['id'] !== $id){
                setcookie("user_id", "", time() - 3600*24*30*12, "/");
                setcookie("user_hash", "", time() - 3600*24*30*12, "/");
            } else {
                $isAuth = true;
                $this->session->setProp('user', $userData);
            }
        }
        return $isAuth;
    }

    public function userAuth()
    {
        $request = new Request();
        $login = $request->getParams()['login'];
        $password = $request->getParams()['password'];
        $remember = $request->getParams()['remember'];
        $isAuth = false;

        $sql = "SELECT `id`, `login`, `password`, `name` FROM `user` WHERE `login` = :login";
        $userData = $this->db->queryOne($sql, ['login' => $login]);
        if ($userData) {
            if($this->passwordCheck($password, $userData['password'])){
                $isAuth = true;
                $this->session->setProp('user', $userData);
            }
        }

        if(!empty($remember) && $remember == 'remember'){
            setcookie("user_id", $userData['id'], time()+86400, "/");
            setcookie("user_hash", $userData['password'], time()+86400, "/");
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
        return $this->session->getProp('user');
    }

    public function getUserId(){
        $user = $this->session->getProp('user');
        if ($user) {
            return $user['id'];
        }
        return null;
    }

    public function logout()
    {
        $this->session->unsetProp('user');
        setcookie("user_id", null, time() - 3600*24*30*12, "/");
        setcookie("user_hash", null, time() - 3600*24*30*12, "/");
        header('Location: /user/login');
    }
}