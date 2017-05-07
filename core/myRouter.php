<?php
namespace core;

use Phalcon\Http\Request;
use Phalcon\Http\Response;
use Phalcon\Mvc\Dispatcher;
use Phalcon\Mvc\Router;
use ReflectionMethod;

/**
 * Created by PhpStorm.
 * User: ThinkPad
 * Date: 2015/3/21
 * Time: 9:30
 * 核心功能如下：
 * 1、中间件的实现
 * 2、模型绑定，model binding的实现，可以在action函数中指定绑定的类型，类似laravel 5.2 提供的一样
 * 3、模型绑定基础上，实现接口绑定
 */

class myRouter extends Router{
    /**
     * @var array
     */
    public $middlewares = [];

    public $middlewaresForEveryRoute = [];

    public $serviceProvider = [];

    protected $stack = [];
    /**
     * myRouter constructor.
     */
    public function __construct($defaultRoutes = false)
    {
        parent::__construct($defaultRoutes);
        if(getMyEnv() == 'web'){
            //        ---------解决中文url不稳定的问题----------
            $this->setUriSource(Router::URI_SOURCE_SERVER_REQUEST_URI);//这种形式对比$_GET('_url')的要稳定，这个函数没有urldecode()，需要手动执行
            $_SERVER['REQUEST_URI'] = urldecode($_SERVER['REQUEST_URI']);
            //       ---------解决中文url不稳定的问题----------
        }

    }


    /**
     * 主要是增加了一个中间件的功能，利用short syntax来增加中间件，这样的好处是路由、中间件在一起，便于管理
     * @param $pattern
     * @param string $path
     * @param array $middleware
     * @return myRoute
     */
    public function addx(string $pattern,string $path,string $routeName=null,array $middleware=[],$httpMethods = null)//给路由添加中间件
    {
        $route = $this->add($pattern,$path,$httpMethods);
        if($routeName) {
            $route->setName($routeName);
        }else{
            $route->setName(str_replace('::','.',$path));
        }
        $this->setRouteMiddlewares($route,$middleware);
        return new myRoute($route,$this);
    }

    public function addPost($pattern, $path = null,$routeName = null,$middleware=[] )
    {
        return $this->addx($pattern,$path,$routeName,$middleware,'POST');
    }

    public function addGet($pattern, $path = null,$routeName = null,$middleware=[] )
    {
        return $this->addx($pattern,$path,$routeName,$middleware,'GET');
    }


    public function group(array $middleware,$callback)
    {
        $this->addMiddlewareToStack($middleware);
        if(is_callable($callback)) call_user_func($callback,$this);
        $this->popMiddlewareFromStack();
    }



// ----------   提供接口绑定, 从interface 到class的绑定----------

    /**
     * @param $key
     * @param $provider
     */
    public function bindProvider($key, $provider)
    {
        $this->serviceProvider[$key]=$provider;
    }

    /**
     * @param $key
     * @return mixed
     */
    public function getProvider($key)
    {
        if(isset($this->serviceProvider[$key])) return $this->serviceProvider[$key];
        return $key;
    }

//---------------命令行中的关于路由的表格生成所需数据-----------
    /**
     * @return array
     */
    public function getTableData($filter=null,$order = null)
    {
        $regex = '|'.$filter.'|i';

        $header = ['pattern','path','middleware','httpMethods','name'];
        $content = [];
        foreach($this->getRoutes() as $route){
            /** @var Router\Route $route */
            $name = $route->getName();
            $pattern = $route->getPattern();
            $path = $this->getPathString($route->getPaths());
            $httpMethods = $this->getHttpMethodsString($route->getHttpMethods());
            $middleWares = $this->getMiddleWaresString($route);
//            $content[]=[$pattern,$path,$middleWares,$httpMethods,$name];
            $content[]=compact('pattern','path','middleWares','httpMethods','name');
        }
        $content = collect($content);

        if($order) $content = $content->sortBy($order);

        if($filter) $content = $content->filter(function($route) use($regex){
            return preg_match($regex,$route['name']);
        });

        return [$header,$content->toArray(),count($this->getRoutes()),$content->count()];
    }
//--------------helper functions for Middleware-----------------------------------------



    /**获得指定的中间件字符串
     * @param $route_id
     * @return array
     *
     *
     */
    public function getMiddleWares($route_id)
    {
        if(isset($this->middlewares[$route_id])) return $this->middlewares[$route_id];
        return null;
    }

    private function getPathString(array $path)
    {
        return $path['controller'].'::'.$path['action'];
    }

    private function getHttpMethodsString($getHttpMethods)
    {
        if(is_array($getHttpMethods)) return '['.implode(',',$getHttpMethods).']';
        if(!$getHttpMethods) return null;
        return '['.$getHttpMethods.']';
    }

    private function getMiddleWaresString(Router\Route $route)
    {
        if(is_array($this->getMiddleWares($route->getRouteId()))) return '['.implode(',',$this->getMiddleWares($route->getRouteId())).']';
        return null;
    }

    private function addMiddlewareToStack($middleware)
    {
        array_unshift($this->stack,$middleware);
    }

    private function popMiddlewareFromStack()
    {
        array_pop($this->stack);
    }

    public function setRouteMiddlewares(Router\RouteInterface $route, array $middleware)
    {
        $middleware = $this->mergeStackedMiddlewares($middleware);
        if(isset($this->middlewares[$route->getRouteId()])) $middleware = array_merge($middleware,$this->middlewares[$route->getRouteId()]);
        $this->middlewares[$route->getRouteId()]=$middleware;
        return $this;
    }



    private function mergeStackedMiddlewares($middleware)
    {
        if(!empty($this->stack)) $middleware = array_merge($middleware,$this->stack[0]);
        return $middleware;
    }

    public function hasMatchedMiddleWares($route_id)
    {
        return isset($this->middlewares[$route_id]);
    }

    public function setMiddlewaresForEveryRoute($middlewares)
    {
        $this->middlewaresForEveryRoute = $middlewares;
    }


}