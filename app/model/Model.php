<?php


namespace app\model;

use app\engine\Db;
use app\interfaces\IModel;
use \PDO;

abstract class Model implements IModel
{
    protected $db;

    public function __construct($param = null)
    {
        $this->db = Db::getInstance();
        if(is_array($param)){
            foreach ($param as $key=>$value) {
                $this->$key = $value;
            }
        }
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

    public static function getObject($id)
    {
        $connection = DB::getInstance()->getConnection();
        $class = get_called_class();
        $table = strtolower(end(explode('\\', $class)));
        $statement = $connection->query("SELECT * FROM {$table} WHERE id = {$id}");
        $statement->setFetchMode( PDO::FETCH_CLASS, $class);
        $item = $statement->fetch();
        return $item;
    }

    public static function getObjectFromDb($id)
    {
        $connection = DB::getInstance()->getConnection();
        $class = get_called_class();
        $table = strtolower(end(explode('\\', $class)));
        $sql = "SELECT * FROM {$table} WHERE id = :id";
        $stmt = $connection->prepare($sql);
        if( ! $stmt ){
            die( "SQL Error: {$this->getConnection()->errorCode()} - {$this->getConnection()->errorInfo()}" );
        }
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        if( ! $stmt ){
            die( "SQL Error: {$this->getConnection()->errorCode()} - {$this->getConnection()->errorInfo()}" );
        }
        $stmt->setFetchMode( PDO::FETCH_CLASS, $class);
        $item = $stmt->fetch();
        return $item;
    }
}