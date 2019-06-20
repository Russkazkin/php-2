<?php


namespace app\tests;


use app\models\entities\User;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{

    /**
     * @param $login
     * @param $password
     * @param $name
     * @param $email
     * @dataProvider providerObjectCreation
     */
    public function testObjectCreation($login, $password, $name, $email)
    {
        $user = new User($login, $password, $name, $email);
        $this->assertEquals($login, $user->getProp('login'));
        $this->assertEquals($password, $user->getProp('password'));
        $this->assertEquals($name, $user->getProp('name'));
        $this->assertEquals($email, $user->getProp('email'));
    }

    public function providerObjectCreation()
    {
        return [
            ['user', 'asjdg9asdhgnsdak', 'User Admin', 'user@user.ru'],
            ['admin', 'hasd07gtadshbkjsa', 'Admin General', 'admin@user.ru'],
        ];
    }
}