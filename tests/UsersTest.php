<?php

use app\model\entities\Users;

class UsersTest extends PHPUnit\Framework\TestCase
{
    /**
     * @dataProvider providerUserParams
     */

    public function testUsers($name, $pass, $info) {
        $user = new Users($name, $pass, $info);
        $this->assertEquals($name, $user->username);
        $this->assertEquals($pass, $user->pass);
        $this->assertEquals($info, $user->info);

    }

    public function providerUserParams()
    {
        return array (
            array ("Vasya", "Pupkin", "Something about"),
            array (1, 2, 3),
            array ("___", "S", ".")
        );
    }


}