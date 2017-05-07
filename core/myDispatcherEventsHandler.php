<?php
/**
 * Created by PhpStorm.
 * User: ThinkPad
 * Date: 2016/12/27
 * Time: 19:49
 */

namespace core;

use Exception;
use Phalcon\Events\Event;
use Phalcon\Mvc\Dispatcher;
use Phalcon\Mvc\User\Plugin;

class myDispatcherEventsHandler extends Plugin
{
    public function beforeDispatchLoop(Event $event, Dispatcher $dispatcher)
    {
//        dd($this->router->getRewriteUri());
        return true;
    }

    public function beforeDispatch(Event $event, Dispatcher $dispatcher)
    {
        $this->getDI()->get(myModelBinding::class)->handle($dispatcher);
//        if(myMiddleWareChecking::CurrentRouteHasMiddleware(\isLogin::class)) {
//            if(!$this->getDI()->get(\isLogin::class)->isValid(true)) return false;
//            $this->getDI()->get(myModelBinding::class)->handle($dispatcher);
//        }
        return true;
    }
    public function beforeExecuteRoute(Event $event,Dispatcher $dispatcher)
    {
        if(!$this->getDI()->get(myMiddleWareChecking::class)->handle($dispatcher)) return false;
        return true;
    }
    public function beforeException(Event $event, Dispatcher $dispatcher, Exception $exception)
    {
        $this->getDI()->get(myExceptionHandler::class)->handle($dispatcher,$exception);
        return false;
    }




}