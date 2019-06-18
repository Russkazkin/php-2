<?php


namespace app\tests;


use app\models\entities\User;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    /**
     * @dataProvider providerObjectCreation
     */
    public function testObjectCreation($a, $b, $c, $d)
    {
        $user = new User($a, $b, $c, $d);
        $this->assertEquals($a, $user->getProp('login'));
        $this->assertEquals($b, $user->getProp('password'));
        $this->assertEquals($c, $user->getProp('name'));
        $this->assertEquals($d, $user->getProp('email'));
    }

    public function providerObjectCreation()
    {
        return [
            ['user', 'asjdg9asdhgnsdak', 'User Admin', 'user@user.ru'],
            ['admin', 'hasd07gtadshbkjsa', 'Admin General', 'admin@user.ru'],
        ];
    }
}