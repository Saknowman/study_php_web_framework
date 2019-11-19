<?php


namespace TaskApp\Middleware;


use Libs\Https\Request;
use Libs\Https\Response;
use Libs\Middleware\BaseMiddleware;

class MiddlewareA extends BaseMiddleware
{

    public function processRequest(Request $request){
        echo "Request pass the Middleware A. <br><br>";
        return $request;
    }

    public function processResponse(Response $response){
        echo "Response pass the Middleware A. <br><br>";
        return $response;
    }
}