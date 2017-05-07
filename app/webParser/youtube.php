<?php
/**
 * Created by PhpStorm.
 * User: ThinkPad
 * Date: 2016/11/29
 * Time: 21:26
 * 这个对象主要就是一个面板对象，可以方便静态调用，可以看做是领域的服务
 */

namespace webParser;

use webParser\youtube\channelParser;
use webParser\youtube\movieParser;
use webParser\youtube\playlistParser;

class youtube
{
    public static function getMovieInfo($key){
        $url = self::getMovieUrlByKey($key);
        $data = (new movieParser($url))->parse();
        $data['key'] = $key;
        return $data;
    }

    public static function getListInfo($key)
    {
        $url = self::getListUrlByKey($key);
        $data = (new playlistParser($url))->parse();
        $data['key'] = $key;
        return $data;
    }

    public static function getChannelInfo($channelUrl)
    {
        $url = self::getChannelUrlByKey($channelUrl);
        $data = (new channelParser($url))->parse();
        return $data;
    }

    /**
     * @param $key
     * @return string
     */
    public static function getMovieUrlByKey($key): string
    {
        $url = 'https://www.youtube.com/watch?v=' . $key;
        return $url;
    }

    /**
     * @param $key
     * @return string
     */
    public static function getListUrlByKey($key): string
    {
        $url = 'https://www.youtube.com/playlist?list=' . $key;
        return $url;
    }

    /**
     * @param $channelUrl
     * @return string
     */
    public static function getChannelUrlByKey($channelUrl): string
    {
        $url = 'https://www.youtube.com' . $channelUrl;
        return $url;
    }

}