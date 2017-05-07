<?php
/**
 * Created by PhpStorm.
 * User: ThinkPad
 * Date: 2017/1/4
 * Time: 19:50
 */

namespace core;


use Symfony\Component\Console\Output\OutputInterface;

interface myJobInterface
{
    public static function execute(array $data,OutputInterface $output = null);

    public static function getUrl($input);
}