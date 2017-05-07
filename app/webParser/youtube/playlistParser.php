<?php
/**
 * Created by PhpStorm.
 * User: ThinkPad
 * Date: 2016/12/4
 * Time: 12:01
 */

namespace webParser\youtube;


use core\myParser;

class playlistParser extends myParser
{
    public function parse()
    {
        //playlist的基本信息
        $title = trim($this->crawler->filter('h1.pl-header-title')->text());
        $channel = $this->crawler->filter('h1.branded-page-header-title a')->attr('href');
        $lastUpdated = $this->crawler->filter('ul.pl-header-details li')->last()->text();
        $lastUpdated = trim(preg_replace('/.+:(.+)/sim', '$1', $lastUpdated));
        //playlist下的视频有哪些？
        $movies = [];
        $this->crawler->filter('table#pl-video-table td.pl-video-title a.pl-video-title-link')->each(function($row) use(&$movies){
            $movies[]=$row->attr('href');
        });

        return compact('title','channel','lastUpdated','movies');
    }
}