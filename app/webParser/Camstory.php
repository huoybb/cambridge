<?php
/**
 * Created by PhpStorm.
 * User: ThinkPad
 * Date: 2017/5/7
 * Time: 10:20
 */

namespace webParser;


use webParser\camstory\bookinfoParser;
use webParser\camstory\booklistParser;

class Camstory
{
    public static function getBooklist(){
        $url = 'http://camstory.cn/index.jsp';
        $data = (new booklistParser($url))->parse();
        return $data;
    }

    public static function getBookInfo($url)
    {
        $data = (new bookinfoParser($url))->parse();
        return $data;
    }
}