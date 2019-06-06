<?php


namespace app\model;

use app\engine\Db;


abstract class DbModel
{

    public $updateFlags = [];

    public function getProp($prop)
    {
        return $this->$prop;
    }

    public function setProp($prop, $value)
    {
        $this->updateFlags[$prop] = true;
        $this->$prop = $value;
    }

    public static function getOne($id)
    {
        $tableName = static::getTableName();
        $sql = "SELECT * FROM {$tableName} WHERE id = :id";
        return Db::getInstance()->queryObject($sql, ['id' => $id], static::class);
    }
    public static function getAll()
    {
        $tableName = static::getTableName();
        $sql = "SELECT * FROM {$tableName}";
        return Db::getInstance()->queryAll($sql);
    }

    public static function getTableName()
    {
        $class = get_called_class();
        $table = strtolower(end(explode('\\', $class)));
        return $table;
    }

    public function insert()
    {
        $tableName = static::getTableName();
        $cols = '';
        $binds = '';
        $arr = [];
        var_dump($this->updateFlags);
        foreach ($this->updateFlags as $key => $value) {
            if ($key == "updateFlags") continue;
            echo $key . '<br>';
            $cols .= "{$key}, ";
            $binds .= ":{$key}, ";
            $arr[$key] = $this->getProp($key);
        }

        $cols = substr($cols, 0, -2);
        $binds = substr($binds, 0, -2);
        $sql = "INSERT INTO {$tableName} ({$cols}) VALUES ({$binds})";

        print $sql;
        print_r($arr);

        Db::getInstance()->execute($sql, $arr);
        $this->id = Db::getInstance()->lastInsertId();

        echo "<p>Запись успешно добавлена в таблицу {$tableName} базы данных. ID: {$this->id}</p>";
    }

    public function delete()
    {
        $tableName = static::getTableName();
        $sql = "DELETE FROM {$tableName} WHERE id = :id";
        Db::getInstance()->execute($sql, ['id' => $this->id]);
        echo "<p>Удалена запись с ID: {$this->id} из таблицы {$tableName}</p>";
    }

    public function save()
    {
        if (is_null($this->id))
            $this->insert();
        else
            $this->update();
    }
}