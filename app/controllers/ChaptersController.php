<?php

/**
 * Created by PhpStorm.
 * User: ThinkPad
 * Date: 2017/5/8
 * Time: 6:13
 */
class ChaptersController extends \core\myController
{
    public function showAction(Chapters $chapter)
    {
        $this->view->setVars(compact('chapter'));
    }

}