<?php


namespace app\models;


use app\engine\Db;
use app\models\entities\DataEntity;
use Exception;

abstract class Repository
{
    protected $db;

    public function __construct()
    {
        $this->db = Db::getInstance();
    }

    public function getOne($id)
    {
        $tableName = $this->getTableName();
        $sql = "SELECT * FROM {$tableName} WHERE id = :id";
        return $this->db->queryObject($sql, ['id' => $id], $this->getEntityClass());
    }

    public function getAll()
    {
        $tableName = $this->getTableName();
        $sql = "SELECT * FROM {$tableName}";
        return $this->db->queryAll($sql);
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

    public function insert(DataEntity $entity)
    {
        $tableName = $this->getTableName();
        $cols = '';
        $binds = '';
        $arr = [];

        foreach ($entity->updateFlags as $key => $value) {
            if ($key == "updateFlags") continue;
            $cols .= "{$key}, ";
            $binds .= ":{$key}, ";
            $arr[$key] = $entity->getProp($key);
        }

        $cols = substr($cols, 0, -2);
        $binds = substr($binds, 0, -2);
        $sql = "INSERT INTO {$tableName} ({$cols}) VALUES ({$binds})";

        $this->db->execute($sql, $arr);
        $entity->id = $this->db->lastInsertId();

        return true;
    }

    public function delete(DataEntity $entity)
    {
        $tableName = $this->getTableName();
        $sql = "DELETE FROM {$tableName} WHERE id = :id";
        $this->db->execute($sql, ['id' => $entity->id]);
    }
    public function update(DataEntity $entity)
    {
        $tableName = $this->getTableName();
        $updateArr = [];
        $values = [];
        foreach ($entity->updateFlags as $key => $value){
            if($value){
                $updateArr[] = "`{$key}` = :{$key}";
                $values[$key] = $entity->getProp($key);
            }
        }
        if(!$updateArr) return false;
        $updates = implode(", ", $updateArr);
        $values['id'] = $entity->getProp('id');
        $sql = "UPDATE `{$tableName}` SET {$updates} WHERE `id` = :id";
        $this->db->execute($sql, $values);
        return true;
    }

    public function save(DataEntity $entity)
    {
        if (is_null($entity->id))
            return $this->insert($entity);
        else
            return $this->update($entity);
    }

    abstract public function getTableName();

    abstract public function getEntityClass();
}