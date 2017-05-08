<?php
/**
 * Created by PhpStorm.
 * User: ThinkPad
 * Date: 2017/3/25
 * Time: 22:53
 */

namespace middlewares;


use core\myMiddleware;

class setUrlBeforeMiddleware extends myMiddleware
{
    /**
     * 1、当get进入编辑、添加、删除的命令界面时，需要设定urlBefore，以便能够在post信息后方便返回
     * 2、当post数据出现异常时，应该保持urlBefore不变
     * 3、当get进入后，没有直接点击post的提交按钮，而是浏览其他页面或者取消操作，则应该清楚urlBefore，以避免出现情况？例如评论页面的返回异常
     * @param $object
     * @return bool
     */
    public function isValid($object): bool
    {
        if($this->request->isGet()){
            $urlBefore = $this->request->getHTTPReferer();
            $urlCurrent = 'http://'.$this->request->getHttpHost().$this->request->getURI();
            if($urlCurrent != $urlBefore) $this->session->set('urlBefore',$this->request->getHTTPReferer());
        }
        return true;
    }
}