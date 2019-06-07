<?php

namespace app\engine;

use app\traits\Tsingletone;

class Db
{
    use Tsingletone;
    private $config = [
        'driver' => 'mysql',
        'host' => 'localhost',
        'port' => 8889,
        'login' => 'user',
        'password' => 'x4kbTNyvus4XNGxa',
        'database' => 'PHP'
    ];

    private $connection = null;

    private function getConnection() {
        if (is_null($this->connection)) {
            $this->connection = new \PDO(
                $this->prepareDsn(),
                $this->config['login'],
                $this->config['password']
            );
            $this->connection->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_ASSOC);
        }
        return $this->connection;
    }

    private function prepareDsn() {
        return sprintf("%s:host=%s;port=%i;dbname=%s",
            $this->config['driver'],
            $this->config['host'],
            $this->config['port'],
            $this->config['database']
            );
    }

    private function query($sql, $params) {
        $stmt = $this->getConnection()->prepare($sql);
        $stmt->execute($params);
        return $stmt;
    }

    public function execute($sql, $params) {
        $this->query($sql, $params);
        return $this->getConnection()->lastInsertId();
    }

    public function build($sql, $id, $class) {
        $stmt = $this->getConnection()->prepare($sql);
        $stmt->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, $class);
        $stmt->execute($id);
        return $stmt->fetch();
    }

    public function queryOne($sql, $params) {
        return $this->queryAll($sql, $params)[0];
    }

    public function queryAll($sql, $params = []) {
        return $this->query($sql, $params)->fetchAll();
    }
}