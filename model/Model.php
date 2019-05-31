<?php

namespace app\model;
use app\engine;
use app\interfaces\IModel;

abstract class Model implements IModel
{
    protected $id;
    protected $db;
    private $tableName;

    public function __construct(engine\Db $db)
    {
        $this->db = $db;
        $this->tableName = strtr(strtolower(get_class($this)), ['app\model\\'=>'']);
    }

    public function getOne($id) {
        $query = "SELECT * FROM {$this->tableName} WHERE id = {$id}";
        $this->db->queryOne($query);
    }

    public function getAll() {
        $query = "SELECT * FROM {$this->tableName}";
        $this->db->queryAll($query);
    }

}