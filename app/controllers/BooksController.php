<?php

/**
 * Created by PhpStorm.
 * User: ThinkPad
 * Date: 2017/5/7
 * Time: 17:53
 */
class BooksController extends \core\myController
{
    public function showAction(Books $book)
    {
        $this->view->setVars(compact('book'));
    }

}