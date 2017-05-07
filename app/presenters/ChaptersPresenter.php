<?php

/**
 * Created by PhpStorm.
 * User: ThinkPad
 * Date: 2017/5/8
 * Time: 6:18
 */
class ChaptersPresenter extends \core\myPresenter
{
    /** @var  Chapters */
    public $entity;
    public function name()
    {
        return str_replace('/','',$this->entity->name);
    }

}