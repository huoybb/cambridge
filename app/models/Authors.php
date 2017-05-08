<?php

class Authors extends \core\myModel
{

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
     * @var string
     * @Column(type="string", length=255, nullable=false)
     */
    public $name;

    /**
     *
     * @var string
     * @Column(type="string", nullable=false)
     */
    public $intr;

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
     *  [
            'name'=>$data['author'],
            'intr'=>$data['author_intr'],
            'notes'=>'作者',
            'authorable'=>$this,
        ]
     * @param $array
     */
    public static function findOrNew($array)
    {
        $instance = static::query()
            ->where('name = :name:',['name'=>$array['name']])
            ->execute()->getFirst();
        if(!$instance){
            $instance = static::saveNew($array);
        }
        Authorables::findOrNewByAuthorAndAuthorable($instance,$array['authorable'],$array['notes']);
        return $instance;
    }

    public static function findByBook(Books $book)
    {
        $rows = static::query()
            ->leftJoin(Authorables::class,'au.author_id = Authors.id','au')
            ->where('au.authorable_type = :type:',['type'=>get_class($book)])
            ->andWhere('au.authorable_id = :id:',['id'=>$book->id])
            ->columns(['Authors.*','au.*'])
            ->execute();
        $result = [];
        foreach($rows as $row){
            $row->authors->authorable = $row->au;
            $result[]=$row->authors;
        }
        return collect($result);
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
        return 'authors';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Authors[]|Authors
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Authors
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
