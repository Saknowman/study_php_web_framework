<?php


namespace Libs\Apps\Auth\Entities;


use Libs\DB\Entity;

class User extends Entity
{
    public string $name;
    public string $password;

    public static function columns()
    {
        return ['name', 'password'];
    }
}