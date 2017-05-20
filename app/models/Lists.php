<?php

class Lists extends \core\myModel
{
    use CommentableTrait;
    use \core\myPresenterTrait;

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=11, nullable=false)
     */
    public $id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    public $index;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=false)
     */
    public $name;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=true)
     */
    public $grade;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=true)
     */
    public $cef;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=true)
     */
    public $esol;

    /**
     *
     * @var string
     * @Column(type="string", nullable=false)
     */
    public $created_at;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    public $updated_at;

    /**
     * @param $key
     * @return \Phalcon\Mvc\ModelInterface | Lists
     */
    public static function findByIndex($key)
    {
        return static::query()
            ->where('index = :key:',['key'=>$key])
            ->execute()->getFirst();
    }

    public static function findByName($listName)
    {
        return static::query()
            ->where('name = :name:',['name'=>$listName])
            ->execute()->getFirst();
    }

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSchema("cambridge");
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'lists';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Lists[]|Lists
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Lists
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }
    public function addBook($data)
    {
        $data['list_id'] = $this->id;
        return Books::saveNew($data);
    }
    public function books()
    {
        return Books::findByList($this);
    }

    public function infoArray()
    {
        return [
            'grade'=>'推荐年级',
            'cef'=>'CEF',
            'esol'=>'ESOL',
            'operations'=>'操作'
        ];
    }




}
