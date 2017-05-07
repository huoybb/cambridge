<?php
/**
 * Created by PhpStorm.
 * User: ThinkPad
 * Date: 2016/10/29
 * Time: 10:49
 */

namespace core;


use Phalcon\Di;
use Phalcon\Mvc\Url;

abstract class myPresenter
{
    public $entity;
    protected $di;
    /**
     * @var Url
     */
    protected $url;

    /**通用的presenter模式
     * http://mylara.zhaobing/tags/presenter
     * myPresenter constructor.
     * @param $entity
     */
    public function __construct($entity,Di $di)
    {
        $this->entity = $entity;
        $this->di = $di;
        $this->url = $this->di->get('url');
    }

    /**
     * @param $property
     * @return mixed
     */
    public function __get($property)
    {
        if(method_exists($this,$property)){
            return $this->{$property}();
        }

        if(property_exists($this->entity,$property)) {
            return $this->entity->$property;
        }
    }

    protected function youtubePrefix($url)
    {
        return 'https://www.youtube.com' . $url;
    }

    /**
     * @param array $items
     * $item = ['url','value','isActive']
     */
    protected function buildBreadcrumbs(array $items): string
    {
        $result = '<ol class="breadcrumb">';
        $last = end($items);
        foreach ($items as $item) {
            if ($item == $last) {
                $result .= "<li class=\"active\">{$item['value']}</li>";
            } else {
                $result .= "<li><a href=\"{$item['url']}\">{$item['value']}</a></li>";
            }
        }
        $result .= '</ol>';
        return $result;
    }
    public function url(array $routeArray){
        return $this->url->get($routeArray);
    }

    /**
     * @param $url
     * @param $title
     * @param array $options
     * @return string
     */
    public function createLink($url, $title, $options=[])
    {
        $optionsString = '';
        foreach($options as $key => $value){
            $optionsString .= " {$key}='{$value}'";
        }
        return "<a href='{$url}' {$optionsString}>$title</a>";
    }


    /**
     * @param $items
     * $items = [['url'=>'xxx.url','title'=>'想看']]
     * @return string
     */
    protected function buildArrayOfLinkButtons(array $items): string
    {
        return collect($items)->map(function ($item) {
            if(isset($item['disabled'])) return $this->createLink($item['url'], $item['title'], ['class'=>$item['class'],'disabled'=>$item['disabled']]);
            return $this->createLink($item['url'], $item['title'], ['class'=>$item['class']]);
        })->implode(' ');
    }

    /**
     * 将上面这个一组buttons变成一个group，更加容易管理和查看
     * @param $ArrayOfLinkButtonsString
     * @return string
     */
    protected function insertButtonsToGroup($ArrayOfLinkButtonsString)
    {
        return "<div class='btn-group'>{$ArrayOfLinkButtonsString}</div>";
    }

    /**
       $this->buildGroupedButton([
         ['url'=>$url1,'title'=>'想看','class'=>"btn btn-warning btn-xs"],
         ['url'=>$url2,'movie'=>$this->entity->id]),'title'=>'在看','class'=>"btn btn-warning btn-xs"],
         ['url'=>$url3,'title'=>'看过','class'=>"btn btn-warning btn-xs"],
       ]);
     * @param array $movieButtons
     * @return string
     */
    protected function buildGroupedButton(array $movieButtons)
    {
        return $this->insertButtonsToGroup($this->buildArrayOfLinkButtons($movieButtons));
    }
    protected function buildSelectedButton(array $buttonLinks){
        $links = '';
        foreach ($buttonLinks as $link){
            $links .= "<li class='btn-xs'><a href='{$link['url']}'>{$link['title']}</a></li> ";
        }
        return '<div class="btn-group"> 
            <button class="btn btn-default btn-xs dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                操作 <span class="caret"></span> 
            </button> 
            <ul class="dropdown-menu"> '.$links.'
            </ul> 
        </div>';
    }

}