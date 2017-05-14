<?php
namespace core;
use Faker\Factory;
use Phalcon\Exception;

/**
 * Created by PhpStorm.
 * User: ThinkPad
 * Date: 2017/5/14
 * Time: 7:03
 */
class myFactory
{
    protected static $definitions = [];
    protected $ClassName;
    protected $closure;

    /**
     * myFactory constructor.
     */
    public function __construct(string $ClassName)
    {
        if(!isset(self::$definitions[$ClassName])){
            self::$definitions[$ClassName] = function(){ return [];};
        }
        $this->ClassName = $ClassName;
        $this->closure = self::$definitions[$ClassName];
    }


    public static function define(string $name,\Closure $closure)
    {
        self::$definitions[$name]=$closure;
    }
    public function create(array $attributes = null,$records = 1)
    {
        if($records == 1) return $this->createOneInstance($attributes);
        $results = [];
        for($i = 1;$i<=$records;$i++){
            $results[]=$this->createOneInstance($attributes);
        }
        return collect($results);
    }

    /**
     * @param array $attributes
     * @return mixed
     */
    protected function createOneInstance(array $attributes)
    {
        $data = ($this->closure)();
        if ($attributes) $data = array_merge($data, $attributes);
        $instance = new $this->ClassName;
        $instance->save($data);
        return $instance;
    }


}