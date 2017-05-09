<?php

/**
 * Created by PhpStorm.
 * User: ThinkPad
 * Date: 2017/3/15
 * Time: 7:10
 */
abstract class basePresenter extends \core\myPresenter
{
    public function description()
    {
        if($this->entity->description) return "<pre>{$this->entity->description}</pre>";
        return null;
    }

    public function breadcrumbs($linkArray = null)
    {
        $navs = $this->buildNavArray();
        if($linkArray){
            $navs[]=$linkArray;
        }
        return $this->buildBreadcrumbs($navs);
    }

    abstract protected function buildNavArray();

    public function showLink()
    {
        $entity = str_singular(strtolower(get_class($this->entity)));
        return $this->createLink($this->url(['for' => str_plural($entity) . '.show', $entity => $this->entity->id]), $this->entity->title);
    }

}