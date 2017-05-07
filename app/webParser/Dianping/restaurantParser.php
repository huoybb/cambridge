<?php
/**
 * Created by PhpStorm.
 * User: ThinkPad
 * Date: 2017/4/20
 * Time: 6:23
 */

namespace webParser\Dianping;


class restaurantParser extends \core\myParser
{

    public function parse()
    {
        $title = trim($this->crawler->filter('h1.shop-name')->text());
        $title = preg_replace('|\s+.+$|','',$title);
        $briefInfo = trim($this->crawler->filter('.brief-info')->text());
        $address = trim($this->crawler->filter('.address .item')->text());
        if($this->crawler->filter('.tel .item')->count()){
            $telephone = trim($this->crawler->filter('.tel .item')->text());
        }else{
            $telephone = ' ';
        }
        $city = trim($this->crawler->filter('.city')->text());
        return compact('title','address','telephone','briefInfo','city');
    }
}