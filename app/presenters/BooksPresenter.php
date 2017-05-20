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
        $info =  $this->stripLinks($this->entity->info);
        $info =  $this->replaceBlankWithBr($info);
        return $this->stripExtrainfo($info);
    }
    public function ISBN()
    {
        if (preg_match('/ISBN：(.*?)<br>/sim', $this->info(), $regs)) {
            return trim($regs[1]);
        }
        return null;
    }

    public function links()
    {
        $result = $this->buildGroupedButton([
            ['url'=>$this->entity->url,'title'=>'原版','class'=>"btn btn-info btn-xs"],
            ['url'=>$this->entity->douban(),'title'=>'豆瓣','class'=>"btn btn-info btn-xs"],
        ]);
        return $result;
    }


    public function operations()
    {
        $result = $this->buildGroupedButton([
            ['url'=>$this->url(['for'=>'books.edit','book'=>$this->entity->id]),'title'=>'编辑','class'=>"btn btn-warning btn-xs"],
            ['url'=>$this->url(['for'=>'books.delete','book'=>$this->entity->id]),'title'=>'删除','class'=>"btn btn-danger btn-xs"],
        ]);

        $opers = [
            ['url'=>$this->url(['for'=>'books.addAuthor','book'=>$this->entity->id]),'title'=>'添加作者','class'=>"btn btn-info btn-xs"],
            ['url'=>$this->url(['for'=>'books.addResources','book'=>$this->entity->id]),'title'=>'添加资源','class'=>"btn btn-info btn-xs"],

        ];

        $result .= $this->buildGroupedButton($opers);
        return $result;
    }
    public function answer()
    {
        $file = "/files/answers/{$this->pdf()}";
        if(!file_exists(BASE_PATH."/public".$file)) return null;
        return $this->createLink($file,'阅读练习答案');
    }
    public function teachplan()
    {
        $file = "/files/teachplans/{$this->pdf()}";
        if(!file_exists(BASE_PATH."/public".$file)) return null;
        return $this->createLink($file,'教师教案');
    }

    public function pdf()
    {
        return "{$this->entity->levelid}_{$this->entity->bid}.pdf";
    }



    private function stripLinks($info)
    {
        return preg_replace('%<a.+?>.+?</a>%sim', '',$info);
    }

    private function replaceBlankWithBr($info)
    {
        return preg_replace('/\s{4}\s+/sim', '<br>', strip_tags($info));
    }

    private function stripExtrainfo($info)
    {
        return preg_replace('/所在丛书：.+$/','',$info);
    }

}