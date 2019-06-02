<?php


namespace app\engine;

use app\traits\TSingleton;
use \PDO;
use PDOException;

class Db
{
    use TSingleton;

    private $config = [
        'driver' => 'mysql',
        'host' => 'docker_php2_mariadb_1',
        'login' => 'shop',
        'password' => 'shop',
        'database' => 'shop',
        'charset' => 'utf8'
    ];

    private $connection = null;


    public function getConnection() {
        try {
            if (is_null($this->connection)) {
                var_dump("Подключаюсь к БД, дооолго.");
                echo $this->prepareDsnString();
                $this->connection = new PDO($this->prepareDsnString(),
                    $this->config['login'],
                    $this->config['password']
                );
                $this->connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            }

            return $this->connection;
        }catch (PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
            die();
        }
    }

    private function prepareDsnString() {
        return sprintf("%s:host=%s;dbname=%s;charset=%s",
            $this->config['driver'],
            $this->config['host'],
            $this->config['database'],
            $this->config['charset']
        );
    }

    private function query($sql, $param) {
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