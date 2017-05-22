<?php
/**
 * Created by PhpStorm.
 * User: ThinkPad
 * Date: 2016/7/10
 * Time: 21:57
 */

namespace core;


use Phalcon\Forms\Element\Date;
use Phalcon\Forms\Element\Submit;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\TextArea;
use Phalcon\Forms\Form;

class myForm extends Form
{
    protected $exludedFields = [];
    protected $only = [];
    public $rules = [];
    public $fields = [];

    /**
     * @param null $model
     */
    public function __construct(myModel $model=null)
    {
        if($model){
            if($this->session->has('_myLastInput')){
                $model->assign($this->session->get('_myLastInput'));
                $this->session->remove('_myLastInput');
            }
            parent::__construct($model);
            $this->initialize($model);
        }
    }

    public function add(\Phalcon\Forms\ElementInterface $element, $position = null, $type = null)
    {
        $label = $this->getElementLableFor($element);
        $element->setLabel($label);

        return parent::add($element);
    }


    //** 下面这些函数都是内部使用的，不对外开发 */

    protected function initialize(myModel $model)
    {
        $fields = [];
        $metaDataTypes = $model->getModelsMetaData()->getDataTypes($model);
//        dd($metaDataTypes);
        foreach ($metaDataTypes as $column => $dataType) {
            if(count($this->only)){
                if(in_array($column, $this->getFieldNames())){
                    $fields[] = $this->addElement($column,$dataType);
                }
            }elseif(!in_array($column, $this->exludedFields)) {
                $fields[] = $this->addElement($column,$dataType);
            };
        }

        $this->fields = $fields;

        if ($model->id) {
            $this->add(new Submit('修改'));
        } else {
            $this->add(new Submit('增加'));
        }
    }

    protected function addElement($column, $dataType=0)
    {

        $element = new Text($column);

        if ($dataType == 1) $element = new Date($column);
        if ($dataType == 6) $element = new TextArea($column,['rows'=>6]);

        $this->add($element);
        return $column;
    }



    // 下面三个是为only这个数组准备的函数，一个是获取标签的数组，一个是定义的数据数据域的数组，还有就是根据数据域返回相应的标签
    protected function getLabelNames()
    {
        if(count($this->only)) return array_values($this->only);
        return [];
    }
    protected function getFieldNames()
    {
        $labels = $this->getLabelNames();
        if(0 == count($labels)) return [];

        $keys = array_keys($this->only);
        foreach($keys as $index=>$value){
            if(is_int($value)) $keys[$index] = $labels[$index];
        }
        return $keys;
    }
    protected function getElementLableFor(\Phalcon\Forms\ElementInterface $element)
    {
        $data = $this->getFieldNames();
        if(0==count($data)) return $element->getName();
        $index = array_search($element->getName(),$data);
        return $this->getLabelNames()[$index];
    }
}