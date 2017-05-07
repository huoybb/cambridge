<?php

class ErrorController extends \core\myController
{


    public function notFoundAction()
    {
        $this->view->myurl = $this->router->getRewriteUri();
    }
    public function resourceNotFoundAction()
    {
        $this->setViewParams();
        return $this->view->render('error','resourceNotFound');//因为打断了正常的流程，需要手动来设置
    }
    public function errorAction()
    {
        $this->setViewParams();
        dd($this->dispatcher->getParam('message'));
//        return $this->view->render('error','error');//因为打断了正常的流程，需要手动来设置
    }

    private function setViewParams()
    {
        $params = ['file','line','message','trace','code','exception'];
        foreach($params as $param){
            $this->view->{$param} = $this->dispatcher->getParam($param);
        }
        if($this->view->isCaching()) $this->view->cache(false);//避免缓存，这样的好处是能够正常显示
    }


}

