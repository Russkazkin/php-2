<?php


namespace app\models\repositories;


use app\models\User;

class UserRepository
{
    public function getEntityClass()
    {
        return User::class;
    }

    public function getTableName() {
        return 'user';
    }
}