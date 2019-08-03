<?php


namespace app\model\repositories;

use app\engine\App;
use app\model\entities\Users;


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

    public function getEntityClass() {
        return Users::class;
    }
}