<?php


namespace Libs\Https;


class Session
{

    private static Session $_instance;
    private static bool $is_session_started = false;
    private static bool $is_session_id_regenerated = false;

    private function __construct()
    {
        if (self::$is_session_started) return;

        $this->startSession();
    }

    public static function instance(){
        if(empty(self::$_instance)){
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    public function set($key, $value)
    {
        $_SESSION[$key] = $value;
    }

    public function get($key, $default = null)
    {
        return isset($_SESSION[$key]) ? $_SESSION[$key] : $default;
    }

    public function unSet($key)
    {
        unset($_SESSION[$key]);
    }

    public function clear()
    {
        $_SESSION = array();
    }

    public function regenerate($destroy = true){
        if(self::$is_session_id_regenerated) return;

        session_regenerate_id($destroy);
        self::$is_session_id_regenerated = true;
    }

    private function startSession(): void
    {
        session_start();
        self::$is_session_started = true;
    }
}