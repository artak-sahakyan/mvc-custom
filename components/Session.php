<?php


namespace app\components;

class Session
{
    protected static $started;

    public static function startSession()
    {
        if (!static::$started) {
            static::$started = true;
            session_start();
        }
    }

    public static function setValue($name, $value)
    {
        self::startSession();
        $_SESSION[$name] = $value;
        return $_SESSION;
    }

    public static function getValue($name, $defaultValue = null)
    {
        self::startSession();
        return $_SESSION[$name] ?? $defaultValue;
    }

    public static function destroy()
    {
        self::startSession();
        if(session_id()) {
            session_destroy();
        }
    }
}