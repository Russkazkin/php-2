<?php


namespace app\model;

use app\engine\Db;
use app\interfaces\IModel;
use \PDO;

abstract class Model implements IModel
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
        return $this->db->queryOne($sql, ['id' => $id]);
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

    /*public static function getObject($id)
    {
        $connection = DB::getInstance()->getConnection();
        $statement = $connection->query("SELECT * FROM product WHERE id = {$id}");
        $class = get_called_class();
        $statement->setFetchMode( PDO::FETCH_CLASS, $class);
        $item = $statement->fetch();
        return $item;
    }*/
}