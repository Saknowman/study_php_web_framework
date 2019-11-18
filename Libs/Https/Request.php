<?php


namespace Libs\Https;


class Request
{
    private static Request $instance;
    private array $headers;

    private function __construct()
    {
        $this->headers = getallheaders();
    }

    public static function instance(): Request
    {
        if (empty(self::$instance)) {
            self::$instance = new Request();
        }

        return self::$instance;
    }

    public function methodType(): string
    {
        if (is_null($this->post('_method')))
            return $_SERVER['REQUEST_METHOD'];
        return $this->post('_method');
    }

    public function get(string $name, $default = null)
    {
        if (isset($_GET[$name]))
            return $_GET[$name];
        return $default;
    }

    public function post($name, $default = null)
    {
        if (isset($_POST[$name]))
            return $_POST[$name];
        return $default;
    }

    /**
     * @param null $name
     * @return array | string
     */
    public function header($name = null)
    {
        if (empty($name))
            return getallheaders();
        return empty($this->headers[$name]) ? '' : $this->headers[$name];
    }

    public function host(): string
    {
        if (!empty($_SERVER['HTTP_HOST']))
            return $_SERVER['HTTP_HOST'];
        return $_SERVER['SERVER_NAME'];
    }

    public function requestUri(): string
    {
        return $_SERVER['REQUEST_URI'];
    }

    public function baseUrl(): string
    {
        $script_name = $_SERVER['SCRIPT_NAME'];
        $request_uri = $this->requestUri();

        if (0 === strpos($request_uri, $script_name))
            return $script_name;
        else if (0 === strpos($request_uri, dirname($script_name)))
            return rtrim(dirname($script_name));

        return '';
    }

    public function pathInfo(): string
    {
        $base_url = $this->baseUrl();
        $request_uri = $this->requestUri();

        $pos = strpos($request_uri, '?');
        if (false !== $pos)
            $request_uri = substr($request_uri, 0, $pos);

        $path_info = (string)substr($request_uri, strlen($base_url));

        return $path_info;
    }

}