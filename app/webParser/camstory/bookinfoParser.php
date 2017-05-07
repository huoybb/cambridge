<?php
/**
 * Created by PhpStorm.
 * User: ThinkPad
 * Date: 2017/5/7
 * Time: 11:02
 */

namespace webParser\camstory;


use core\myParser;
use Symfony\Component\DomCrawler\Crawler;

class bookinfoParser extends myParser
{
    public function parse()
    {
        $info = $this->crawler->filter('.header dd')->html();
        $story = $this->crawler->filter('.story p')->text();
        $chapters = [];
        $this->crawler->filter('.mulu li')->each(function($row) use(&$chapters){
            /** @var $row Crawler */
            $index = $row->attr('index');
            $name = trim($row->text());
            $chapters[]=compact('index','name');
        });
        $author = $this->crawler->filter('.jj')->html();
        return compact('info','story','chapters','author');
    }
}