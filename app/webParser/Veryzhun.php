<?php
/**
 * Created by PhpStorm.
 * User: ThinkPad
 * Date: 2017/3/19
 * Time: 20:32
 */

namespace webParser;


use Carbon\Carbon;
use Phalcon\Http\Request;
use webParser\Veryzhun\PlaneParser;

class Veryzhun
{
    public static function getPlaneInfo($key,Request $request){
        $url = static ::getVeryZhunURL($key,$request);
        $data = (new PlaneParser($url))->parse();
        $data['key'] = $key;
        if($request->getQuery('fdate')) {
            $data['date']= $request->getQuery('fdate');
        }else{
            $data['date']= Carbon::now()->format('Ymd');
        }

        return $data;
    }
    public static function getPlaneInfoByUrl($url){
        $data = (new PlaneParser($url))->parse();

        return $data;
    }

    private static function getVeryZhunURL($key,Request $request)
    {
        $data = [];
        foreach($request->getQuery() as $key1=>$value1){
            if($key1 != '_url') $data[]="{$key1}={$value1}";
        }
        return 'http://www.variflight.com/schedule/'. $key . '?'. implode('&',$data);
    }

}