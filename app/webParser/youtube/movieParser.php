<?php
/**
 * Created by PhpStorm.
 * User: ThinkPad
 * Date: 2016/11/29
 * Time: 21:40
 */

namespace webParser\youtube;


use core\myParser;

class movieParser extends myParser
{

    public function parse()
    {
        $title = trim($this->crawler->filter('.watch-title')->text());
        $uploader_url = $this->crawler->filter('#watch7-user-header a')->attr('href');
        $channel_url = $this->crawler->filter('div.yt-user-info a')->attr('href');
        $channel_title = $this->crawler->filter('div.yt-user-info a')->text();
        $description = $this->crawler->filter('#eow-description')->html();
        return compact('title','uploader_url','channel_url','channel_title','description');
    }
}