<?php


namespace Libs\Middleware;


use Libs\Https\Request;
use Libs\Https\Response;

class BaseMiddleware
{
    protected bool $_have_to_return_response_immediately = false;

    /**
     * Every request pass here.
     * You can edit request in here like set request->user.
     *
     * Return request if you want continue.
     * Return response if you want return response immediately like 401 response.
     *
     * @param Request $request
     * @return Request|Response
     */
    public function processRequest(Request $request){
        return $request;
    }

    /**
     * Every responses pass here.
     * You can edit response in here like set cookie header.
     *
     * Set true to $this->_have_to_return_response_immediately if you want return response immediately.
     *
     * @param Response $response
     * @return Response
     */
    public function processResponse(Response $response){
        return $response;
    }

    public function haveToReturnResponse(){
        return $this->_have_to_return_response_immediately;
    }
}