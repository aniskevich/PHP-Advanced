<?php

namespace app\model;
use app\engine\Db;

abstract class DbModel extends Models
{
    protected $db;
    private $tableName;

    public function __construct()
    {
        $this->db = Db::getInstance();
        $this->tableName = strtr(strtolower(get_class($this)), ['app\model\\'=>'']);
    }

    public function buildFromDb($id) {
        $query = "SELECT * FROM {$this->tableName} WHERE id = :id";
        return $this->db->build($query, [':id' => $id], get_class($this));
    }

    public function getOne($id) {
        $query = "SELECT * FROM {$this->tableName} WHERE id = :id";
        return $this->db->queryOne($query, [':id' => $id]);
    }

    public function getAll() {
        $query = "SELECT * FROM {$this->tableName}";
        return $this->db->queryAll($query);
    }

    public function getWhere($name, $value) {
        $query = "SELECT * FROM {$this->tableName} WHERE {$name} = '{$value}'";
        return $this->db->queryAll($query);
    }

    public function getLimit($from, $to) {
        $query = "SELECT * FROM {$this->tableName} LIMIT :from, :to";
        return $this->db->queryAll($query, [':from' => $from, ':to' => $to]);
    }

    public function insert() {
        $params = json_decode(json_encode($this),TRUE);
        unset($params['id']);
        $keys = implode(',', array_keys($params));
        $values = ':'.implode(',:', array_keys($params));
        $query = "INSERT INTO {$this->tableName} ({$keys}) VALUES ({$values})";
        $this->db->execute($query, $params);
        $this->id = $this->db->lastInsertId();

    }

    public function delete() {
        $query = "DELETE FROM {$this->tableName} WHERE id = :id";
        $this->db->execute($query, [':id' => $this->id]);
    }

    public function update() {
        $new = json_decode(json_encode($this),TRUE);
        $original = $this->getOne($this->id);
        $params = array_diff($new, $original);
        unset($params['id']);
        $str = '';
        foreach ($params as $keys => $values) {
            $str .= $keys . " = :" . $keys . ", ";
        }
        $str = substr($str, 0, -2);
        $query = "UPDATE {$this->tableName} SET {$str} WHERE id = :id";
        $params['id'] = $this->id;
        $this->db->execute($query, $params);
    }
}
