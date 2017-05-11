<?php

/**
 * Created by PhpStorm.
 * User: ThinkPad
 * Date: 2017/5/8
 * Time: 18:13
 */
class BooksPresenter extends \core\myPresenter
{
    /** @var  Books */
    public $entity;
    public function info()
    {
        return preg_replace('%<a.+?>.+?</a>%sim', '', $this->entity->info);
    }

    public function operations()
    {
        $result = $this->buildGroupedButton([
            ['url'=>$this->url(['for'=>'books.edit','book'=>$this->entity->id]),'title'=>'编辑','class'=>"btn btn-warning btn-xs"],
            ['url'=>$this->url(['for'=>'books.delete','book'=>$this->entity->id]),'title'=>'删除','class'=>"btn btn-danger btn-xs"],
        ]);

        $opers = [
            ['url'=>$this->entity->url,'title'=>'链接','class'=>"btn btn-info btn-xs"],
            ['url'=>$this->url(['for'=>'books.addAuthor','book'=>$this->entity->id]),'title'=>'添加作者','class'=>"btn btn-info btn-xs"],
        ];

        $result .= $this->buildGroupedButton($opers);
        return $result;
    }
    public function answer()
    {
        return $this->createLink("/files/answers/{$this->pdf()}",'阅读练习答案');
    }
    public function teachplan()
    {
        return $this->createLink("/files/teachplans/{$this->pdf()}",'教师教案');
    }

    public function pdf()
    {
        return "{$this->entity->levelid}_{$this->entity->bid}.pdf";
    }

}