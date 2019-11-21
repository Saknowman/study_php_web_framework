<?php


namespace Libs\Apps\Auth\Middleware;


use Libs\Https\Request;
use Libs\Middleware\BaseMiddleware;
use Libs\Apps\Auth\Services\AuthService;

class AuthMiddleware extends BaseMiddleware
{
    public function processRequest(Request $request){
        $request->user = AuthService::getLoginUser();
        return $request;
    }
}