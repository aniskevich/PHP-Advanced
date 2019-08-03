<?php

namespace app\model\repositories;

use app\engine\App;
use app\interfaces\IModel;
use app\model\entities\DataEntity;

abstract class Repository implements IModel
{
    protected $db;
    protected $tableName;

    public function __construct()
    {
        $this->db = App::call()->db;
        $this->tableName = strtr(strtolower(get_class($this)), ['app\model\repositories\\'=>'', 'repository' => '']);
    }

    public function buildFromDb($id) {
        $query = "SELECT * FROM {$this->tableName} WHERE id = :id";
        return $this->db->build($query, [':id' => $id], get_class($this));
    }

    public function getOne($id) {
        $query = "SELECT * FROM {$this->tableName} WHERE id = :id";
        return $this->db->build($query, [':id' => $id], $this->getEntityClass());
    }

    public function getAll() {
        $query = "SELECT * FROM {$this->tableName}";
        return $this->db->queryAll($query);
    }

    public function getWhere($name, $value) {
        $query = "SELECT * FROM {$this->tableName} WHERE {$name} = '{$value}'";
        return $this->db->queryAll($query);
    }

    public function getCountWhere($name, $value) {
        $query = "SELECT count(*) as count FROM {$this->tableName} WHERE $name = :$name";
        return $this->db->queryOne($query, ["$name" => $value])['count'];
    }

    public function getLimit($from, $to) {
        $query = "SELECT * FROM {$this->tableName} LIMIT :from, :to";
        return $this->db->queryAll($query, [':from' => $from, ':to' => $to]);
    }

    private function insert(DataEntity $entity) {
        $params = json_decode(json_encode($entity),TRUE);
        unset($params['id']);
        $keys = implode(',', array_keys($params));
        $values = ':'.implode(',:', array_keys($params));
        $query = "INSERT INTO {$this->tableName} ({$keys}) VALUES ({$values})";
        $this->db->execute($query, $params);
        $entity->id = $this->db->lastInsertId();
    }

    public function delete(DataEntity $entity) {
        $query = "DELETE FROM {$this->tableName} WHERE id = :id";
        $this->db->execute($query, [':id' => $entity->id]);
    }

    private function update(DataEntity $entity) {
        $new = json_decode(json_encode($entity),TRUE);
        $original = $this->getWhere('id', $entity->id)[0];
        $params = array_diff($new, $original);
        unset($params['id']);
        $str = '';
        foreach ($params as $keys => $values) {
            $str .= $keys . " = :" . $keys . ", ";
        }
        $str = substr($str, 0, -2);
        $query = "UPDATE {$this->tableName} SET {$str} WHERE id = :id";
        $params['id'] = $entity->id;
        $this->db->execute($query, $params);
    }

    public function save(DataEntity $entity) {
        if (is_null($entity->id))
            $this->insert($entity);
        else
            $this->update($entity);
    }

}