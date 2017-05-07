<?php
namespace core;
use Phalcon\Di;

/**
 * Created by PhpStorm.
 * User: ThinkPad
 * Date: 2016/1/11
 * Time: 20:20
 * 提供一个全局的事件处理管理器
 */
class myEventsManager extends \Phalcon\Events\Manager
{
    // $this->listen('auth:login','authEventHandler::login');
    /**
     * @param $eventName
     * @param $handlerAction
     */
    public function listen($eventName, $handlerAction)
    {
        $this->attach($eventName,function($event,$object=null,$data=null) use($handlerAction){
            if (preg_match('/(.+)::(.+)/m', $handlerAction, $regs)) {
                $handlerName = $regs[1];
                $action = $regs[2];
                $handler = new $handlerName;
                $handler->$action($event,$object,$data);
            }
        });
    }
    public function register($eventDomain, array $handlerClassArray)
    {
        foreach($handlerClassArray as $handler){
//                $this->attach($eventDomain,new $handler);
            $this->attach($eventDomain,function($e,$eventObject)use($handler){
                $actionName = 'when'.get_class($eventObject);
                $handler = myDI::getDefault()->get($handler);
                if(method_exists($handler,$actionName)){
                    $handler->$actionName($eventObject);
                }
            });
        }
    }

    /**
     * @param $event
     */
    public function trigger($event)
    {
        $eventName = $this->getEventName($event);
        $this->fire($eventName,$event);
    }


//    ---------------helper functions ---------------------

    public function getAllEvents()
    {
        return $this->_events;
    }
    private function getEventName($event)
    {
        return $this->getEventPrefix().':'.get_class($event);
    }
    public function getEventPrefix()
    {
        return Di::getDefault()->get('config')->application->eventPrefix;
    }



}