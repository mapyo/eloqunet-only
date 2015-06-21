<?php
namespace Mapyo\EloquentOnly;

use \Illuminate\Database\Capsule\Manager as Capsule;
use \Illuminate\Events\Dispatcher;
use \Illuminate\Container\Container;

class Manager
{
    private static $eloquent = null;

    public static function getInstance()
    {
        static $instance = null;
        if (null === $instance) {
            $instance = new static();
        }
        return $instance;
    }

    protected function __construct()
    {
    }

    public function init(array $config)
    {
        if (null !== $this->eloquent) {
            return;
        }

        $this->eloquent = new Capsule;
        $this->eloquent->addConnection($config);
        $this->eloquent->setEventDispatcher(new Dispatcher(new Container));
        $this->eloquent->setAsGlobal();
        $this->eloquent->bootEloquent();
    }

    public function __call($method, $params)
    {
        return call_user_func_array(array($this->eloquent, $method), $params);
    }
}
