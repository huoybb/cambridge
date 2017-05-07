<?php
/**
 * Created by PhpStorm.
 * User: ThinkPad
 * Date: 2017/3/19
 * Time: 20:35
 */

namespace webParser\Veryzhun;


use core\myParser;

class PlaneParser extends myParser
{

    public function parse()
    {
        $title = trim($this->crawler->filter('.tit span b')->text());
        $dcity = trim($this->crawler->filter('.flyProc .cir_l')->text());
        $acity = trim($this->crawler->filter('.flyProc .cir_r')->text());
        $length = trim($this->crawler->filter('.flyProc .p_ti')->text());

        $type = trim($this->crawler->filter('.flyProc .p_info .mileage')->text());
        $age = trim($this->crawler->filter('.flyProc .p_info .time')->text());
        $time = trim($this->crawler->filter('.flyProc .p_info .age')->text());

        $dtime = trim($this->crawler->filter('.fly_mian .date')->text());
        $atime = trim($this->crawler->filter('.fly_mian .date')->eq(1)->text());
        $dterminal= trim($this->crawler->filter('.fly_mian h2')->text());
        $aterminal= trim($this->crawler->filter('.fly_mian h2')->eq(1)->text());

        return compact('title','dcity','acity','length','type','age','time','dtime','atime','dterminal','aterminal');
    }
}