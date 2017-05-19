<?php
/**
 * Created by PhpStorm.
 * User: ThinkPad
 * Date: 2017/5/19
 * Time: 6:50
 */

namespace webParser;


use webParser\blcup\bookinfoParser;

class blcup
{
    public static function getBookInfo($url)
    {
        $data = (new bookinfoParser($url))->parse();
        $data['url']=$url;
        return $data;
    }

    public static function getBookInfoBykey($key)
    {
        $url = "http://www.blcup.com/PInfo/index/$key";
        return self::getBookInfo($url);
    }
}