<?php


namespace app\engine;



class Session
{
    public function setProp($prop, $value)
    {
        $_SESSION[$prop] = $value;
    }

    public function getProp($prop)
    {
        if (isset($_SESSION[$prop])) {
            return $_SESSION[$prop];
        } else {
            return null;
        }
    }

    public function unsetProp($prop)
    {
        if (isset($_SESSION[$prop])) {
            unset($_SESSION[$prop]);
            return true;
        } else {
            return false;
        }
    }
}