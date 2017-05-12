<?php

class ErrorController extends \core\myController
{

    /**
     * 这个是发生路由没有定义的时候
     */
    public function notFoundAction()
    {
        $this->view->myurl = $this->router->getRewriteUri();
    }

    /**
     * 这个异常是发生在dispatch前？因此需要这里的重新用view的render吗？ 奇怪！！
     * @return bool|\Phalcon\Mvc\View
     */
    public function resourceNotFoundAction()
    {
        $this->setViewParams();
        return $this->view->render('error','resourceNotFound');//因为打断了正常的流程，需要手动来设置
    }

    /**
     * 一般情况下，需要进一步的完善看看都有哪些异常可能发生？
     */
    public function errorAction()
    {
        $this->setViewParams();
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

