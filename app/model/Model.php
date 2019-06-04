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
        $sql = "SELECT * FROM {$table} WHERE id = :id";
        $stmt = $connection->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        if( ! $stmt ){
            die( "SQL Error: {$connection->errorCode()} - {$connection->errorInfo()}" );
        }
        $stmt->setFetchMode( PDO::FETCH_CLASS, $class);
        $item = $stmt->fetch();
        return $item;
    }

    public function insert()
    {
        $tableName = $this->getTableName();
        $cols = '';
        $binds = '';
        $arr = [];
        foreach ($this as $key => $value) {
            if($key != 'db'){
                $cols .= "{$key}, ";
                $binds .= ":{$key}, ";
                $arr[$key] = $value;
            }
        }
        $cols = substr($cols, 0, -2);
        $binds = substr($binds, 0, -2);
        $sql = "INSERT INTO {$tableName} ({$cols}) VALUES ({$binds})";

        $connection = $this->db->getConnection();
        $stmt = $connection->prepare($sql);
        $res = $stmt->execute($arr);
        $this->id = $connection->lastInsertId();
        if(!$res){
            die( var_dump($stmt->errorInfo() ));
        }
        echo "<p>Запись успешно добавлена в таблицу {$tableName} базы данных. ID: {$this->id}</p>";
    }
}