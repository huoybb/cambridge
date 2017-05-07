<?php
/**
 * Created by PhpStorm.
 * User: ThinkPad
 * Date: 2017/1/6
 * Time: 16:17
 */

namespace core;


use Symfony\Component\Console\Application;

class myConsoleApplication extends Application
{
    public function registerCommands(array $CommandsArray)
    {
        foreach($CommandsArray as $commandName){
            $this->add(new $commandName);
        }
    }

}