<?php
/**
 * Created by PhpStorm.
 * User: ThinkPad
 * Date: 2016/12/14
 * Time: 19:07
 */

namespace core;


use Phalcon\Di\InjectionAwareInterface;
use Phalcon\Forms\Form;
use Phalcon\Mvc\Dispatcher;

/**
 * Class myMiddleWareChecking
 * @package core
 *
 */

class myMiddleWareChecking extends myDIAwareClass
{

    public function handle(Dispatcher $dispatcher = null)
    {
        $dispatcher = $dispatcher ?: $this->dispatcher;

        $route = $this->router->getMatchedRoute();

        if(null == $route) return true; //没有找到正确的路由，无效路由，可以由notFound函数来处理

        if($middleWares = $this->router->getMiddleWares($route->getRouteId())){
            foreach($middleWares as $middleWareString){
                list($data,$validator) = $this->getValidatorAndData($middleWareString,$dispatcher);
                if(method_exists($validator,'before') && $validator->before()) continue;
                if(! $validator->isValid($data)) return false;
            }
        }

        return true;
    }

    private function getValidatorAndData($validator,Dispatcher $dispatcher)
    {
        $data = null;
        if(preg_match('|.*:.*|',$validator)) {//此处设置了可以带中间件参数
            list($validator,$data) = explode(':',$validator);
            $data = $dispatcher->getParam($data);
        }
        /** @var myMiddleware $validator */
        $validator = $this->getDI()->get($validator);

        if(is_a($validator,Form::class)){//如果中间件是form的话，则通过下面进行转换
            $validator = $this->getDI()->get(myValidation::class)->setRules($validator->rules);
        }

        return [$data,$validator];
    }
    public static function CurrentRouteHasMiddleware($middlewareName){

        /** @var myRouter $router */
        $router = myDI::getDefault()->get('router');
        $route = $router->getMatchedRoute();
        if(!$route) return false;//如果当前没有匹配的路由
        $middlewares = $router->getMiddleWares($route->getRouteId());
        if(in_array($middlewareName,$middlewares)) return true;
        return false;
    }
}