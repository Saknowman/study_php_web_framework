<?php


namespace Libs\Apps\Auth;


use Libs\Apps\Auth\Controllers\UserController;

class RoutingTable extends \Libs\Routing\RoutingTable
{
    protected array $urlPatterns = [
        ['', 'GET', UserController::class, 'myPage'],
        ['sign-up', 'GET', UserController::class, 'signUpForm'],
        ['sign-up', 'POST', UserController::class, 'signUp'],
        ['login', 'GET', UserController::class, 'loginForm'],
        ['login', 'POST', UserController::class, 'login'],
        ['logout', 'GET', UserController::class, 'logout'],
    ];
}