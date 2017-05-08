<?php

/**
 * Created by PhpStorm.
 * User: ThinkPad
 * Date: 2016/12/5
 * Time: 6:48
 */
class CommentsForm extends \core\myForm
{
    protected $only = ['content'];
    public $rules = [
        'content'=>['required'=>'评论不能为空，请重新填写评论']
    ];
}