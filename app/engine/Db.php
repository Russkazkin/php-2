<?php


namespace app\engine;

use app\traits\TSingleton;
use \PDO;

class Db
{
    use TSingleton;

    private $config = [
        'driver' => 'sqlite',
        'host' => 'shop_db',
        'login' => 'shop',
        'password' => 'shop',
        'database' => 'shop',
        'charset' => 'utf8'
    ];

    private $connection = null;


    public function getConnection() {
        if (is_null($this->connection)) {
            var_dump("Подключаюсь к БД, дооолго.");
            $this->connection = new PDO($this->prepareDsnString(),
                $this->config['login'],
                $this->config['password']
            );
            $this->connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        }

        return $this->connection;
    }

    private function prepareDsnString() {
        return sprintf("%s:host=%s;dbname=%s;charset=%s",
            $this->config['driver'],
            $this->config['host'],
            $this->config['database'],
            $this->config['charset']
        );
    }
// SELECT * FROM products WHERE id = :id, ['id' => 1]
    private function query($sql, $param) {
        print_r($this->getConnection());
        $stmt = $this->getConnection()->prepare('SELECT * FROM `product`');
        echo $sql;
        if( ! $stmt ){
            die( "SQL Error: {$this->getConnection()->errorCode()} - {$this->getConnection()->errorInfo()}" );
        }
        $stmt->execute($param);
        return $stmt;
    }

    public function execute($sql, $params) {
        $this->query($sql, $params);
        return true;
    }


    public function queryOne($sql, $param = []) {
        return $this->queryAll($sql, $param)[0];
    }
    public function queryAll($sql, $param = []) {
        return $this->query($sql, $param)->fetchAll();
    }

}