<?php

namespace app\model;

class Users extends DbModel
{
    public $id;
    public $username;
    public $pass;
    public $info;

    public function __construct($username = null, $pass = null, $info = null)
    {
        parent::__construct();
        $this->username = $username;
        $this->pass = $pass;
        $this->info = $info;
    }
}