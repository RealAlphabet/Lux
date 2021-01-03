<?php

class Session
{
    public static function regenerate() {
        session_regenerate_id();
    }

    public static function flush() {
        session_destroy();
    }

    public static function set($key, $value) {
        $_SESSION[$key] = $value;
    }

    public static function flash($key, $value) {
        $_SESSION['_$'][$key] = $value;
    }

    public static function forget($key) {
        unset($_SESSION[$key]);
    }

    public static function get($key) {
        return $_SESSION[$key]
            ?? $_SESSION['_$'][$key]
            ?? null;
    }

    public static function all() {
        return $_SESSION;
    }
}
