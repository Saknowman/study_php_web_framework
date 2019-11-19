<?php


namespace Libs\Middleware;


use Libs\Https\Response;

class MiddlewareManager
{
    private array $_middleware_list = [];

    public function __construct($middleware_list)
    {
        foreach ($middleware_list as $middleware) {
            $this->_middleware_list[] = new $middleware;
        }
    }

    public function processRequest($request)
    {
        $result = $request;
        foreach ($this->_middleware_list as $middleware) {
            $result = $middleware->processRequest($result);
            if ($result instanceof Response)
                break;
        }

        return $result;
    }

    public function processResponse($response) : Response
    {
        $result = $response;
        foreach (array_reverse($this->_middleware_list) as $middleware) {
            $result = $middleware->processResponse($result);
            if ($middleware->haveToReturnResponse())
                break;
        }

        return $result;
    }

}