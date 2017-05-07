<?php
/**
 * Created by PhpStorm.
 * User: ThinkPad
 * Date: 2016/12/3
 * Time: 13:32
 */

namespace core;


use Phalcon\Di;
use Phalcon\DiInterface;

abstract class myMiddleware extends myDIAwareClass
{
    public static function over($objectstring)
    {
        return static::class . ':' . $objectstring;
    }

    public function redirect($routeArray)
    {
        $url = $this->url->get($routeArray);
        return $this->response->redirect($url);
    }
    public function redirectBack()
    {
        $url = $this->request->getServer('HTTP_REFERER');
        return $this->response->redirect($url);
    }


    abstract  public function isValid($object):bool;

}