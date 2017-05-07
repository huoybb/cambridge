<?php

/**
 * Created by PhpStorm.
 * User: ThinkPad
 * Date: 2017/3/12
 * Time: 10:35
 */
namespace webParser\Dianping;
class hotelParser extends \core\myParser
{

    public function parse()
    {
        $scoreByDianping = '';

        $title = trim($this->crawler->filter('h1')->text());
        $city = trim($this->crawler->filter('.city')->text());
        $address = trim($this->crawler->filter('.hotel-address-box')->text());
        if($this->crawler->filter('.hotel-scope')->count()) $scoreByDianping = trim($this->crawler->filter('.hotel-scope')->text());
        $info = trim($this->crawler->filter('.hotel-info')->html());
        return compact('title','city','address','scoreByDianping','info');

    }
}