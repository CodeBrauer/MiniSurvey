<?php

/**
* Make some views
*/
class View
{

    const VIEWS_DIR = 'views/';

    public static function load($name, $data = false)
    {
        if (is_array($data)) {
            extract($data);
        }
        $file = self::VIEWS_DIR . $name . '.php';
        $file = realpath(__DIR__ . '/../' .$file);

        if (file_exists($file)) {
            require_once $file;
        } else {
            throw new Exception("View file not found", 6);
            
        }
    }
}