<?php

/**
 * Created by PhpStorm.
 * User: ThinkPad
 * Date: 2017/5/12
 * Time: 6:03
 */
class BooksForm extends \core\myForm
{
    protected $only = [
        'index'=>'序号','name'=>'书名','url','story'=>'故事简介','list_id'=>'等级','douban_id'=>'豆瓣ID','baiduyun'=>'百度云'
    ];
    public $rules = [
        'name'=>'required',
        'url'=>'required',
    ];

    /**
     * BooksForm constructor.
     */
    public function __construct(Books $book = null)
    {
        parent::__construct($book);
        $this->add(new \Phalcon\Forms\Element\Select('list_id',Lists::find(),[
            'using'=>['id','name'],
            'class'=>'form-control',
        ]));
    }

}