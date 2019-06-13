<?php


namespace app\models;

class User extends DbModel
{
    protected $id;
    protected $login;
    protected $password;
    protected $name;
    protected $email;

    public function __construct($login = null,
                                $password = null,
                                $name = null,
                                $email = null)
    {
        $this->login = $login;
        $this->password = $password;
        $this->name = $name;
        $this->email = $email;

        foreach ($this as $key => $value) {
            $this->updateFlags[$key] = false;
        }
    }
}