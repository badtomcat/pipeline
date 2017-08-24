<?php

/**
 * @date 2017/6/8 17:50:44
 */
namespace Tian;

class Pipeline {
    /**
     * @var array
     */
    protected $middlewares = [];

    protected $request;
    public function send($request)
    {
        $this->request = $request;
        return $this;
    }

    public function through($middlewares)
    {
        $this->middlewares = $middlewares;
        return $this;
    }

    public function then(Closure $destination)
    {
        $pipes = array_reverse($this->middlewares);
        $run = array_reduce($pipes, function ($carry, $pipe) {
            return function ($passable) use ($carry, $pipe) {
                return call_user_func_array($pipe, [$passable, $carry]);
            };
        }, function ($passable) use ($destination){
            return call_user_func($destination, $passable);
        });
        return call_user_func($run, $this->request);
    }
}