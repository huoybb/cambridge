<?php
/**
 * Created by PhpStorm.
 * User: ThinkPad
 * Date: 2017/5/7
 * Time: 10:20
 */

namespace webParser\camstory;


use core\myParser;
use Symfony\Component\DomCrawler\Crawler;

class booklistParser extends myParser
{

    public function parse()
    {
        $listNames = [];
        $this->crawler->filter('#list a')->each(function($row) use(&$listNames) {
                /** @var $row Crawler */
                $listNames[] = trim($row->text());
        });

        $booklist = [];
        $this->crawler->filter('#tushu ul')->each(function($row)use(&$booklist){
            /** @var $row Crawler */
            $books = [];
            $row->filter('li')->each(function($bookrow) use(&$books){
                /** @var $bookrow Crawler */
                $url = 'http://camstory.cn/'.$bookrow->filter('a')->first()->attr('href');
                $img = $bookrow->filter('img')->first()->attr('src');
                $name = trim($bookrow->filter('dd')->text());
                $books[] = compact('url','img','name');
            });
            $booklist[]=$books;
        });
        return compact('listNames','booklist');
    }
}