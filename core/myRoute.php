<?php
/**
 * Created by PhpStorm.
 * User: ThinkPad
 * Date: 2016/12/6
 * Time: 5:17
 */

namespace core;


use Phalcon\Mvc\Router\Route;

class myRoute
{
    /**
     * @var Route
     */
    protected $route;

    protected $myRouter;

    public function __construct($_route,myRouter $myRouter)
    {
        $this->route = $_route;
        $this->myRouter = $myRouter;
    }
    public function setName($name)
    {
        $this->route->setName($name);
        return $this;
    }
    public function setMiddlewares($middlewares)
    {
        if(is_string($middlewares)) $middlewares = [$middlewares];
        $this->myRouter->setRouteMiddlewares($this->route,$middlewares);
    }


}