<?php


namespace app\models;

use app\engine\Db;
use \Exception;


abstract class DbModel extends Model
{

    public $updateFlags = [];

    public function getProp($prop)
    {
        return $this->$prop;
    }

    public function setProp($prop, $value)
    {
        if(isset($this->$prop)) {
            $this->updateFlags[$prop] = true;
            $this->$prop = $value;
        }else{
            throw new Exception('Свойство не найдено');
        }

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
        return true;
    }

    public function delete()
    {
        $tableName = static::getTableName();
        $sql = "DELETE FROM {$tableName} WHERE id = :id";
        Db::getInstance()->execute($sql, ['id' => $this->id]);
        echo "<p>Удалена запись с ID: {$this->id} из таблицы {$tableName}</p>";
    }
    public function update()
    {
        $tableName = static::getTableName();
        $updateArr = [];
        $values = [];
        foreach ($this->updateFlags as $key => $value){
            if($value){
                $updateArr[] = "`{$key}` = :{$key}";
                $values[$key] = $this->getProp($key);
            }
        }
        if(!$updateArr) return false;
        $updates = implode(", ", $updateArr);
        $values['id'] = $this->getProp('id');
        $sql = "UPDATE `{$tableName}` SET {$updates} WHERE `id` = :id";
        Db::getInstance()->execute($sql, $values);
        return true;
    }

    public function save()
    {
        if (is_null($this->id))
            return $this->insert();
        else
            return $this->update();
    }

    public function getTwigArr()
    {
        $propsArr = [];
        foreach ($this->updateFlags as $key => $flag){
            $propsArr[$key] = $this->getProp($key);
        }
        return $propsArr;
    }
}