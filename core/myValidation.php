<?php
/**
 * Created by PhpStorm.
 * User: ThinkPad
 * Date: 2016/12/15
 * Time: 13:30
 */

namespace core;


use Exception;
use Phalcon\Validation\Validator\Between;
use Phalcon\Validation\Validator\Date;
use Phalcon\Validation\Validator\Digit;
use Phalcon\Validation\Validator\Email;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\StringLength;
use Phalcon\Validation\Validator\Numericality;

class myValidation extends myMiddleware
{

    protected $rules = [];
    protected $validatorMapper = [
        'email' => Email::class,
        'required' => PresenceOf::class,
        'digit'=>Digit::class,
        'date'=>Date::class,
        'length'=>StringLength::class,
        'between'=>Between::class,
        'number'=>Numericality::class,
    ];
    public function setRules(array $rules)
    {
        $this->rules = $rules;
        return $this;
    }


    public function isValid($object=null): bool
    {
        if ($this->request->isPost()) {
            $data = $this->request->get();
//            dd($data);
            $messages = $this->getValidator()->validate($data);
            if (count($messages)) {
                foreach ($messages as $message) {
                    $this->flash->error($message);
                }
                $this->session->set('_myLastInput',$data);
                $this->redirectBack();
                return false;
            }
        }
        return true;
    }

    protected function getValidator($rules = null)
    {
        $rules = $rules ?: $this->rules;
        $validation = new \Phalcon\Validation();
        foreach ($rules as $field => $validationExpression) {
            if(is_string($validationExpression)){
                foreach ($this->getValidatorClass($validationExpression) as $validatorClass) {
                    $validation->add($field, new $validatorClass);
                }
            }
            if(is_array($validationExpression)){
                foreach($validationExpression as $validator=>$message){
                    $this->checkValidatorExistance($validator);
                    $validatorClass = $this->validatorMapper[$validator];
                    $validation->add($field,new $validatorClass(['message'=>$message]));
                }
            }

        }
        return $validation;
    }

    protected function getValidatorClass($validationExpression)
    {
        $results = preg_split('!\s*\|\s*!', $validationExpression);
        foreach ($results as $key => $value) {
            $value = trim($value);
            if(!$value) throw new Exception('please check your rule definition:'.$validationExpression);
            $this->checkValidatorExistance($value);
            $results[$key] = $this->validatorMapper[$value];
        }
        return $results;
    }

    /**
     * @param $value
     * @throws Exception
     */
    protected function checkValidatorExistance($value)
    {
        if (!isset($this->validatorMapper[$value])) throw new Exception("validator:{$value} is not defined!");
    }
}