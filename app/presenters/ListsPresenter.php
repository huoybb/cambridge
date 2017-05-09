<?php

/**
 * Created by PhpStorm.
 * User: ThinkPad
 * Date: 2017/5/9
 * Time: 7:15
 */
class ListsPresenter extends \core\myPresenter
{
    /** @var  Lists */
    public $entity;
    public function operations()
    {
        $result = $this->buildGroupedButton([
            ['url'=>$this->url(['for'=>'lists.edit','list'=>$this->entity->id]),'title'=>'编辑','class'=>"btn btn-warning btn-xs"],
            ['url'=>$this->url(['for'=>'lists.delete','list'=>$this->entity->id]),'title'=>'删除','class'=>"btn btn-danger btn-xs"],
        ]);
        return $result;
    }
    public function showLink()
    {
        $entity = str_singular(strtolower(get_class($this->entity)));
        return $this->createLink($this->url(['for' => str_plural($entity) . '.show', $entity => $this->entity->id]), $this->entity->name)."({$this->entity->books()->count()})";
    }

}