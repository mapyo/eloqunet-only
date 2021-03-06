<?php
namespace Mapyo\EloquentOnly;

class Eloquent
{
    static public function init(array $config)
    {
        Manager::getInstance()->init($config);
    }

    static public function __callStatic($method, $params)
    {
        return call_user_func_array(array(Manager::getInstance(), $method), $params);
    }
}
