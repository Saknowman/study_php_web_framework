<?php


namespace Libs\Apps\Auth\Controllers;


use Libs\Controllers\Controller;
use Libs\Apps\Auth\Services\AuthService;

class UserController extends Controller
{

    public function myPage($params)
    {
        if (AuthService::isAuthenticated() === false)
            return $this->redirect('/auth/login');
        return $this->render(
            'auth/my_page',
            ['user' => $this->_request->user]);
    }

    public function signUpForm($params)
    {
        return $this->render('auth/sign_up');
    }

    public function signUp($params)
    {
        $errors = AuthService::addNewUser($this->_request->post('name'), $this->_request->post('password'));
        if (count($errors) === 0)
            return $this->redirect('/auth/login');
        return $this->render('auth/sign_up', ['errors' => $errors]);
    }

    public function loginForm($params)
    {
        return $this->render('auth/login');
    }

    public function login($params)
    {
        $failed_result = $this->render('auth/login', ['error' => 'Name or password is correct.']);
        $user = AuthService::getUser($this->_request->post('name'));
        if (is_null($user))
            return $failed_result;

        if (AuthService::login($user, $this->_request->post('password')))
            return $this->redirect('/auth/');

        return $failed_result;
    }

    public function logout($params)
    {
        AuthService::logout();
        return $this->redirect('/auth/login');
    }

}