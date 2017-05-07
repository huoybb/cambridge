<?php
/**
 * Created by PhpStorm.
 * User: ThinkPad
 * Date: 2016/10/29
 * Time: 11:16
 */

namespace core;


use Exception;
use Phalcon\Di;

trait myPresenterTrait
{
    private  $_presenter = null;
    public function present($property=null)
    {
        if($this->_presenter == null){
            $className = $this->getPresenterName();
            if(!class_exists($className)) throw new Exception("{$className}类不存在，请先定义！");
            $di = Di::getDefault();
            $this->_presenter = new $className($this,$di);
        }
        if($property == null){
            return $this->_presenter;
        }
        return $this->_presenter->{$property};
    }
    private function getPresenterName ()
    {
        return get_class($this).'Presenter';
    }
}