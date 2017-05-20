<?php
/**
 * Created by PhpStorm.
 * User: ThinkPad
 * Date: 2017/5/19
 * Time: 6:50
 */

namespace webParser;


use Lists;
use webParser\blcup\bookinfoParser;

class blcup
{
    public static function getBookInfo($url)
    {
        $data = (new bookinfoParser($url))->parse();

        $data['url']=$url;
        static ::fetchPosterFromWeb($data['img']);
        if($list_id = static :: getListIdByName($data['name'])) $data['list_id'] = $list_id;

        return $data;
    }

    public static function getBookInfoBykey($key)
    {
        $url = "http://www.blcup.com/PInfo/index/$key";
        return self::getBookInfo($url);
    }

    protected static function fetchPosterFromWeb($imgUrl)
    {
        $img = file_get_contents($imgUrl);
        file_put_contents('images/'.basename($imgUrl),$img);
    }

    protected static function getListIdByName($name)
    {
        if (preg_match('/^.+（(.+)）/sim', $name, $regs)) {
            $listName = $regs[1];
            $list = Lists::findByName($listName);
            if($list) return $list->id;
        }
        return null;
    }
}