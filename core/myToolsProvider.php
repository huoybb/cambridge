<?php
/**
 * Created by PhpStorm.
 * User: ThinkPad
 * Date: 2016/12/14
 * Time: 22:11
 */

namespace core;


class myToolsProvider extends myProvider
{
    public function setService()
    {
        return function(){
            $mytools = new myTools();
            return $mytools;
        };
    }

}