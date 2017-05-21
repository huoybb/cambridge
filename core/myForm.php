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

    protected function initialize(myModel $model)
    {
        $fields = [];
        $metaDataTypes = $model->getModelsMetaData()->getDataTypes($model);
//        dd($metaDataTypes);
        foreach ($metaDataTypes as $column => $dataType) {
            if(count($this->only)){
                if(in_array($column, $this->getFieldNames('only'))){
                    $fields[] = $this->addElement($column,$dataType);
                }
            }elseif(!in_array($column, $this->getFieldNames('exludedFields'))) {
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

    public function addElement($column, $dataType=0)
    {

        $element = new Text($column);

        $this->add(new Text($column));
        if ($dataType == 1) $element = new Date($column);
        if ($dataType == 6) $element = new TextArea($column,['rows'=>6]);

        $this->add($element);
        return $column;
    }
    public function add(\Phalcon\Forms\ElementInterface $element, $position = null, $type = null)
    {
        $label = $this->getElementLableFor($element);
        $element->setLabel($label);

        return parent::add($element);
    }


    protected function addStatusSelect()
    {
        $this->add(new \Phalcon\Forms\Element\Select('status', ['open' => 'open', 'closed' => 'closed'], [
            'class' => 'form-control',
            'default' => 'open'
        ]));
        $this->fields[] = 'status';
    }
    public function getLableNames($name = 'only')
    {
        if($name == 'only') return array_values($this->only);
        return array_values($this->exludedFields);
    }
    public function getFieldNames($name = 'only')
    {
        $data = $this->exludedFields;
        if($name == 'only') {
            $data = $this->only;
        }
        $labels = $this->getLableNames($name);
        $keys = array_keys($data);
        foreach($keys as $index=>$value){
            if(is_int($value)) $keys[$index] = $labels[$index];
        }
        return $keys;
    }

    private function getElementLableFor(\Phalcon\Forms\ElementInterface $element)
    {
        $arrayFields = 'exludedFields';
        if(count($this->only)){
            $arrayFields = 'only';
        }
        $data = $this->getFieldNames('exludedFields');
        if($arrayFields == 'only') $data = $this->getFieldNames('only');
        $index = array_search($element->getName(),$data);
        return $this->getLableNames($arrayFields)[$index];
    }


}