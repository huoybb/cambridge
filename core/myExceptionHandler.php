<?php
/**
 * Created by PhpStorm.
 * User: ThinkPad
 * Date: 2017/1/10
 * Time: 20:58
 */

namespace core;


use core\Exceptions\ModelBindingNotFoundException;
use Exception;
use Phalcon\Mvc\Dispatcher;
use Phalcon\Mvc\User\Plugin;

class myExceptionHandler extends Plugin
{
    public function handle(Dispatcher $dispatcher, Exception $exception)
    {
        if($exception instanceof ModelBindingNotFoundException){
            return $this->handleException($dispatcher,$exception,'error@resourceNotFound');
        }

        return $this->handleException($dispatcher,$exception,'error@error');
    }
    protected function handleException(Dispatcher $dispatcher, Exception $exception,$action)
    {
        $ActionArray = $this->parseAction($action);
        $dispatcher->forward($ActionArray);
        $dispatcher->setParam('message', $exception->getMessage());
        $dispatcher->setParam('line',$exception->getLine());
        $dispatcher->setParam('file',$exception->getFile());
        $dispatcher->setParam('code',$exception->getCode());
        $dispatcher->setParam('trace',$exception->getTraceAsString());
        $dispatcher->setParam('exception',$exception);


        $dispatcher->dispatch();//由于异常处理时中断了正常的引导过程，需要单独来重新dispatch
    }

    private function parseAction($action)
    {
        $data = explode('@',$action);
        return ['controller'=>$data[0],'action'=>$data[1]];
    }
}