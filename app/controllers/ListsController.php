<?php

/**
 * Created by PhpStorm.
 * User: ThinkPad
 * Date: 2017/5/7
 * Time: 17:44
 */
class ListsController extends \core\myController
{
    public function showAction(Lists $list)
    {
        $this->view->setVars(compact('list'));
    }

}