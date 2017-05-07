<?php
namespace core;
/**
 * Created by PhpStorm.
 * User: ThinkPad
 * Date: 2015/7/16
 * Time: 13:44
 */
use Carbon\Carbon;
use Closure;
use Phalcon\Mvc\Model;
use Projects;

abstract class myModel extends Model{

    /**
     * 仿照Laravel对时间的数据进行处理，便于将来的使用
     * @var Carbon
     */
    public $created_at = null;

    public static $rowsets = [];
    public static function findFirst($parameters = null)
    {
        if (!isset(static::$rowsets[static::class][$parameters])) static::$rowsets[static::class][$parameters] = parent::findFirst($parameters);
        return static::$rowsets[static::class][$parameters];
    }

    public function beforeSave()
    {
        if($this->created_at != null) {
            if(is_a($this->created_at,Carbon::class)) $this->created_at = $this->created_at->toDateTimeString();
        }else{
            $this->created_at = Carbon::now()->toDateTimeString();
        }

        //考虑人为更新这个时间戳的时候，这个时间戳应该是字符串，否则就新生成一个新的时间戳
        if(is_a($this->updated_at,Carbon::class) OR null == $this->updated_at) $this->updated_at = Carbon::now()->toDateTimeString();
        return true;
    }

    public function afterFetch()
    {
        if(isset($this->created_at)) $this->created_at = Carbon::parse($this->created_at);
        if(isset($this->updated_at)) $this->updated_at = Carbon::parse($this->updated_at);
    }

    public function getClassName()
    {
        return get_class($this);
    }


    protected $instance = [];
    //增加临时缓存，避免重复查询，例如在files下索取comments、tags、revs等需要增加一个缓存来减少数据库的查询次数
    public function make($object,Closure $closure)
    {
        if(!isset($this->instance[$object])){
            $this->instance[$object] = $closure();
        }
        return $this->instance[$object];
    }

    //增加缓存功能，利用redis来做缓存，对于大的数据可以采用这个来也许更加方便,需要注意，这里用的压缩算法是igbinary，不是很常见的

    static public function saveNew($data){
        $instance = new static();
        $instance->save($data);
        return $instance;
    }
    //增加每个模型的form对象，便于表单的生成
    protected $_form = null;
    public function getForm()
    {
        $formClass = get_class($this) . 'Form';
        if (!$this->_form) $this->_form = new $formClass(clone $this);
        return $this->_form;
    }

    public function getCacheKey()
    {
        return get_class($this) . ':show:' . $this->id;
    }

    /**
     * Returns the custom events manager
     *
     * @return myEventsManager
     */
    public function getEventsManager() {
        return myDI::getDefault()->get('eventsManager');
    }

    /**
     * 避免int类型出现''，空字符串的现象，在这里将空字符串都用null来代替
     * @param $data
     * @return array
     */
    protected function filterNotEmpty($data)
    {
        $result = [];
        foreach ($data as $key => $value) {
            if (!!$value) {
                $result[$key] = $value;
            }else{
                $result[$key] = null;
            }
        }
        return $result;
    }
    public function save($data = null, $whiteList = null)
    {
        if($data){
            $data = $this->filterNotEmpty($data);
        }
        parent::save($data,$whiteList);
    }


} 