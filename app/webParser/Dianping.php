<?php
/**
 * Created by PhpStorm.
 * User: ThinkPad
 * Date: 2017/3/12
 * Time: 10:34
 */

namespace webParser;


use webParser\Dianping\hotelParser;
use webParser\Dianping\restaurantParser;

class Dianping
{

    public static function getHotelInfo($key){
        $url = self::getHotelUrl($key);
        $data = (new hotelParser($url))->parse();
        $data['key']=$key;
        return $data;
    }

    public static function getRestaurantInfo($key){
        $url = self::getRestaurantUrl($key);
        $data = (new restaurantParser($url))->parse();
        $data['key']=$key;
        return $data;
    }

    private static function getHotelUrl($key)
    {
        return "http://www.dianping.com/newhotel/{$key}";
    }

    private static function getRestaurantUrl($key)
    {
        return "http://www.dianping.com/shop/{$key}";
    }
}