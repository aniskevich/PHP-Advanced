<?php


namespace app\model\repositories;

use app\engine\App;


class UsersRepository extends Repository
{

    public function auth($login, $pass)
    {
        $user = $this->getWhere('username', $login);

        if ($pass == $user[0]["pass"]) {
            App::call()->session->init($login, $user[0]['id'], $user[0]['role']);
            return true;
        }
        return false;
    }
}