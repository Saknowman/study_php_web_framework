<?php


namespace TaskApp\Middleware;


use Libs\Https\Request;
use Libs\Https\Response;
use Libs\Middleware\BaseMiddleware;

class MiddlewareB extends BaseMiddleware
{

    public function processRequest(Request $request){
        echo "Request pass the Middleware B. <br><br>";
        return $request;
    }

    public function processResponse(Response $response){
        echo "Response pass the Middleware B. <br><br>";
        return $response;
    }
}