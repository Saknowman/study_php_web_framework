<?php


namespace Libs\Apps\Auth\Middleware;


use Libs\Https\Request;
use Libs\Https\Response;
use Libs\Middleware\BaseMiddleware;
use Libs\Apps\Auth\Services\UsersService;

class RequiredAuthenticationMiddleware extends BaseMiddleware
{
    public static array $IGNORE_URL_PATTERNS = ['/^auth\/(login|sign-up)$/'];
    private array $_ignore_url_patterns;

    public function __construct()
    {
        $this->_ignore_url_patterns = self::$IGNORE_URL_PATTERNS;
    }

    public function processRequest(Request $request)
    {
        if (UsersService::isAuthenticated())
            return $request;
        foreach ($this->_ignore_url_patterns as $ignore_url_pattern) {
            if (preg_match($ignore_url_pattern, $request->pathInfo()))
                return $request;
        }
        return Response::redirect('/auth/login');
    }
}