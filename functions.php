<?php

namespace Helper;

/**
 * autoload function
 * @param  string $class class name
 * @return null
 */
function autoLoadClass($class) {
    require_once 'library/' . $class . '.php';
}

/**
 * returns the called route
 * @return string route
 */
function getRoute($index = false) {
    $base_path = '/e3fi/umfragetool/'; //called from http://localhost/e3fi/umfragetool/
    $base_path = '';                  //called from http://umfragetool.e3fi.local/ 
    
    $route = str_replace($base_path, '', ltrim($_SERVER['REQUEST_URI'], '/'));
    $route = (empty($route)) ? false : explode('/', $route);

    if ($index !== false && $route !== false) {
        if (!isset($route[$index])) {
            return false;
        }
        return $route[$index];
    }
    return false;
}