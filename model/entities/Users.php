<?php

namespace app\model\entities;

class Users extends DataEntity
{
    public $id;
    public $username;
    public $pass;
    public $info;

    public function __construct($username = null, $pass = null, $info = null)
    {
        $this->username = $username;
        $this->pass = $pass;
        $this->info = $info;
    }
}