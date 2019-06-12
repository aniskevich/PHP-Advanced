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

    public function auth($login, $pass)
    {
        $user = $this->getWhere('username', $login);

        if ($pass == $user[0]["pass"]) {
            $_SESSION['login'] = $login;
            $_SESSION['user_id'] = $user[0]['id'];
            $_SESSION['pages'] = []; //либо выгружать посещенные страницы из БД
            return true;
        }
        return false;
    }
}