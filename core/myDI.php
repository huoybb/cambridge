<?php
namespace core;
use Phalcon\Di\FactoryDefault;

/**
 * Created by PhpStorm.
 * User: ThinkPad
 * Date: 2016/6/6
 * Time: 11:23
 */
class myDI extends FactoryDefault
{
    public function register(array $providers)
    {
        foreach($providers as $name => $provider){ new $provider($name,$this);}
    }
    public static function make($serviceName){
        return static::getDefault()->get($serviceName);
    }
}