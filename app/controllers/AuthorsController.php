<?php

/**
 * Created by PhpStorm.
 * User: ThinkPad
 * Date: 2017/5/9
 * Time: 7:06
 */
class AuthorsController extends \core\myController
{
    public function showAction(Authors $author)
    {
        $this->view->setVars(compact('author'));
    }

}