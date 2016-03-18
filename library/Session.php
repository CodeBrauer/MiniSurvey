<?php

class Session
{
    
    public function __construct()
    {
        switch ($this->status()) {
            case PHP_SESSION_NONE:      session_start(); break;
            case PHP_SESSION_DISABLED:  die('Session must be enabled to use this software.'); break;
        }
    }

    public function set($key, $value)
    {
        $_SESSION[$key] = $value;
    }

    public function get($key)
    {
        return $_SESSION[$key];
    }

    public function exists($key)
    {
        return isset($_SESSION[$key]);
    }

    public function delete($key)
    {
        unset($_SESSION[$key]);
    }

    public function status()
    {
        return session_status();
    }

    public function destroy()
    {
        session_destroy();
    }
}