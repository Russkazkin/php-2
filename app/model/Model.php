<?php


namespace model;

use engine\Db;
use interfaces\IModel;

abstract class Model implements IModel
{
    protected $db;

    public function __construct(Db $db)
    {
        $this->db = $db;
    }

    public function getOne($id)
    {
        $tableName = $this->getTableName();
        $sql = "SELECT * FROM {$tableName} WHERE id = {$id}";
        return $this->db->queryOne($sql);
    }

    public function getAll()
    {
        $tableName = $this->getTableName();
        $sql = "SELECT * FROM {$tableName}";
        return $this->db->queryAll($sql);
    }

    public function getTableName()
    {
        $class = __CLASS__;
        $table = strtolower(end(explode('\\', $class)));
        return $table;
    }
}