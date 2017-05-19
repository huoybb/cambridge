<?php
/**
 * Created by PhpStorm.
 * User: ThinkPad
 * Date: 2017/5/19
 * Time: 6:51
 */

namespace webParser\blcup;


use core\myParser;

class bookinfoParser extends myParser
{
    public function parse()
    {
        $name = $this->crawler->filter('h2')->text();
        $img = 'http://www.blcup.com'.$this->crawler->filter('.img-thumbnail')->attr('src');
        $info = $this->crawler->filter('.listrit5b1')->html();
        $story = $this->crawler->filter('.psection')->first()->html();
        $author = $this->crawler->filter('.psection')->eq(1)->html();

        return compact('img','name','info','story','author');
    }
}