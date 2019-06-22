<?php


namespace app\model\repositories;


class UsersRepository extends Repository
{

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