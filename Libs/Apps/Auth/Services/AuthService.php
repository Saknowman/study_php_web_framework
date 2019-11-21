<?php


namespace Libs\Apps\Auth\Services;


use Libs\DB\DBManager;
use Libs\Https\Session;
use Libs\Apps\Auth\Entities\User;

class AuthService
{
    const AUTHENTICATED_KEY = '_authenticated';
    const AUTH_ID_KEY = '_auth_id';

    public static function getLoginUser($is_secure = true)
    {
        $user =  self::_repository()->get(self::_session()->get(self::AUTH_ID_KEY));
        if (empty($user))
            return $user;
        if($is_secure === false)
            return $user;
        $user->password = '';
        return $user;
    }

    public static function getUser($name)
    {
        $result = self::_repository()->where('name', '=', $name);
        return empty($result[0]) ? null : $result[0];
    }

    public static function login(User $user, $password)
    {
        if (password_verify($password, $user->password) === false) {
            return false;
        }

        self::_session()->set(self::AUTHENTICATED_KEY, true);
        self::_session()->set(self::AUTH_ID_KEY, $user->id);
        self::_session()->regenerate();
        return true;
    }

    public static function logout()
    {
        self::_session()->set(self::AUTHENTICATED_KEY, false);
        self::_session()->set(self::AUTH_ID_KEY, false);
        self::_session()->regenerate();
    }

    public static function isAuthenticated()
    {
        return self::_session()->get(self::AUTHENTICATED_KEY) === true;
    }

    public static function addNewUser($name, $password)
    {
        $errors = [];
        if (self::_repository()->isUniqueName($name) === false) {
            $errors['name'] = "'{$name}'' is already exists.";
        };

        if (strlen($password) < 8) {
            $errors['password'] = "Password required at least 8 letters.";
        }

        if (count($errors) === 0)
            self::_repository()->add($name, $password);
        return $errors;
    }

    protected static function _repository()
    {
        return DBManager::instance()->repository('users');
    }

    protected static function _session()
    {
        return Session::instance();
    }

}