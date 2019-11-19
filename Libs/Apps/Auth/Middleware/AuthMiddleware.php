<?php


namespace Libs\Apps\Auth\Middleware;


use Libs\Https\Request;
use Libs\Middleware\BaseMiddleware;
use Libs\Apps\Auth\Services\UsersService;

class AuthMiddleware extends BaseMiddleware
{
    public function processRequest(Request $request){
        $request->user = UsersService::getLoginUser();
        return $request;
    }
}