<?php
/**
 * Created by PhpStorm.
 * User: ThinkPad
 * Date: 2016/12/6
 * Time: 13:36
 */

namespace core;


use Phalcon\Http\Request;
use Phalcon\Http\Response;

abstract class myNextMiddleware extends myMiddleware
{

    protected $routePara;
    public function isValid($object): bool
    {
        $this->routePara = $object;
        $this->response = $this->handle($this->request,$this->response);
        return true;
    }

    abstract public function handle(Request $request,Response $response);
}