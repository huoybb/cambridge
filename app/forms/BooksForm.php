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
        'index','name','url','info','story','author','list_id','levelid','bid','douban_id'
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