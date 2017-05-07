<?php
namespace core;
/**
 * Created by PhpStorm.
 * User: ThinkPad
 * Date: 2016/6/6
 * Time: 12:02
 */
abstract class myProvider
{
    protected $di;

    /**
     * routerProvider constructor.
     * $name  服务的名称
     * @param $name
     * @param myDI $di
     */
    public function __construct($name,myDI $di)
    {
        $this->di = $di;
        $this->di->setShared($name,$this->setService());
    }

    /**
     * @return callable
     */
    abstract public function setService();
}