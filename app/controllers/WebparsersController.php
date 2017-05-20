<?php

/**
 * Created by PhpStorm.
 * User: ThinkPad
 * Date: 2017/5/19
 * Time: 7:13
 */
class WebparsersController extends \core\myController
{
    public function getbookinfoAction($key)
    {
        $book = Books::findByBlcupKey($key);

        return $this->redirect(['for'=>'books.show','book'=>$book->id]);
    }
}