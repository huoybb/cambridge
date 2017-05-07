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
                if(in_array($column, $this->only)){
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

    private function addElement($column, $dataType)
    {
        $this->add(new Text($column));
        if ($dataType == 1) $this->add(new Date($column));
        if ($dataType == 6) $this->add(new TextArea($column,['rows'=>6]));


        return $column;
    }

    protected function addStatusSelect()
    {
        $this->add(new \Phalcon\Forms\Element\Select('status', ['open' => 'open', 'closed' => 'closed'], [
            'class' => 'form-control',
            'default' => 'open'
        ]));
        $this->fields[] = 'status';
    }
}