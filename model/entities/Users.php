<?php

namespace app\model\entities;

class Users extends DataEntity
{
    public $id;
    public $username;
    public $pass;
    public $info;
    public $role;
    public $email;
    public $gender;
    public $link;

    public function __construct($username = null, $pass = null, $info = null, $email, $gender)
    {
        $this->username = $username;
        $this->pass = $pass;
        $this->info = $info;
        $this->role = 'user';
        $this->email = $email;
        $this->gender = $gender;
        $this->link = 'user.jpg';
    }
}