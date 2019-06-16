<?php


namespace app\models;


use app\engine\Db;
use Exception;

abstract class Repository
{
    public $updateFlags = [];
    protected $db;

    public function __construct()
    {
        foreach ($this as $key => $value) {
            $this->updateFlags[$key] = false;
        }
        $this->db = Db::getInstance();
    }

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

    public function getOne($id)
    {
        $tableName = $this->getTableName();
        $sql = "SELECT * FROM {$tableName} WHERE id = :id";
        return $this->db->queryObject($sql, ['id' => $id], static::class);
    }
    public function getAll()
    {
        $tableName = $this->getTableName();
        $sql = "SELECT * FROM {$tableName}";
        return $this->db->queryAll($sql);
    }

    public function getTableName()
    {
        $class = get_called_class();
        $table = strtolower(end(explode('\\', $class)));
        return $table;
    }

    public function getCountWhere($field, $value)
    {
        $tableName = $this->getTableName();
        $sql = "SELECT count(*) as count FROM {$tableName} WHERE `{$field}`=:{$field}";
        return $this->db->queryOne($sql, ["{$field}" => $value])['count'];
    }

    public function getSumWhere($column, $field, $value)
    {
        //Метод не тестировался
        $tableName = $this->getTableName();
        $sql = "SELECT sum(:column) as `sum` FROM {$tableName} WHERE `{$field}`=:{$field}";
        return $this->db->queryOne($sql, ['column' => $column, "{$field}" => $value])['sum'];
    }

    public function insert()
    {
        $tableName = $this->getTableName();
        $cols = '';
        $binds = '';
        $arr = [];

        foreach ($this->updateFlags as $key => $value) {
            if ($key == "updateFlags") continue;
            $cols .= "{$key}, ";
            $binds .= ":{$key}, ";
            $arr[$key] = $this->getProp($key);
        }

        $cols = substr($cols, 0, -2);
        $binds = substr($binds, 0, -2);
        $sql = "INSERT INTO {$tableName} ({$cols}) VALUES ({$binds})";

        $this->db->execute($sql, $arr);
        $this->id = $this->db->lastInsertId();

        return true;
    }

    public function delete()
    {
        $tableName = $this->getTableName();
        $sql = "DELETE FROM {$tableName} WHERE id = :id";
        $this->db->execute($sql, ['id' => $this->id]);
    }
    public function update()
    {
        $tableName = $this->getTableName();
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
        $this->db->execute($sql, $values);
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