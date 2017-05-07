<?php
/**
 * Created by PhpStorm.
 * User: ThinkPad
 * Date: 2016/12/14
 * Time: 22:10
 */

namespace core;


class myTools
{
    public function my_substr($str, $start, $len)
    {
        $tmpstr = "";
        $strlen = $start + $len;
        for($i = 0; $i < $strlen; $i++)
        {
            if( ord( substr($str, $i, 1) ) > 0xa0 )
            {
                $tmpstr .= substr($str, $i, 3);
                $i += 2;
            } else
                $tmpstr .= substr($str, $i, 1);
        }
        return $tmpstr;
    }

    public function cut($string,$maxLength=50){
//        $result = mb_substr($string,0,$maxLength,'utf-8');
        $result = mb_strcut($string,0,$maxLength,'utf-8');
        if(mb_strlen($string) > $maxLength) $result .= ' ...';
        return $result;
    }
    public function storeAttachment(\Phalcon\Http\Request\File $attachment)
    {
        $uploadDir = 'files'; //上传路径的设置
        $time = time();
        $path = $this->makePath($uploadDir,$time);

        $ext = preg_replace('%^.*?(\.[\w]+)$%', "$1", $attachment->getName()); //获取文件的后缀
        $url = md5($attachment->getName());

        $filename = $path . $time . $url . $ext;

        $attachment->moveTo($filename);

        return $filename;
    }

    public function makePath($uploaddir, $time)
    {
        $year = date('Y', $time);
        $month = date('m', $time);
        $day = date('d', $time);

        $path = $this->isDirOrMkdir($uploaddir . '/');
        $path = $this->isDirOrMkdir($path . $year . '/');
        $path = $this->isDirOrMkdir($path . $month . '/') ;
        $path = $this->isDirOrMkdir($path . $day . '/') ;
        return $path;
    }
    public function isDirOrMkdir($path)
    {
        if (! is_dir($path)) mkdir($path);
        return $path;
    }

    public function formatSizeUnits($bytes)
    {
        if ($bytes >= 1073741824)
        {
            $bytes = number_format($bytes / 1073741824, 2) . ' GB';
        }
        elseif ($bytes >= 1048576)
        {
            $bytes = number_format($bytes / 1048576, 2) . ' MB';
        }
        elseif ($bytes >= 1024)
        {
            $bytes = number_format($bytes / 1024, 2) . ' KB';
        }
        elseif ($bytes > 1)
        {
            $bytes = $bytes . ' bytes';
        }
        elseif ($bytes == 1)
        {
            $bytes = $bytes . ' byte';
        }
        else
        {
            $bytes = '0 bytes';
        }

        return $bytes;
    }
    public function transformTo($className,$dataObject)
    {
        $object = new $className;
        foreach($dataObject as $key=>$value){
                $object->{$key} = $value;
        }
        $object->afterFetch();
        return $object;
    }


}