<?php

class Authorables extends \core\myModel
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
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    public $author_id;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=false)
     */
    public $notes;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=false)
     */
    public $authorable_type;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    public $authorable_id;

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

    public static function findOrNewByAuthorAndAuthorable(Authors $author, $authorable, $notes)
    {
        $instance = static::query()
            ->where('author_id = :author:',['author'=>$author->id])
            ->andWhere('authorable_type = :type:',['type'=>get_class($authorable)])
            ->andWhere('authorable_id = :id:',['id'=>$authorable->id])
            ->andWhere('notes = :notes:',['notes'=>$notes])
            ->execute()->getFirst();
        if(!$instance){
            $instance = static::saveNew([
                'author_id'=>$author->id,
                'authorable_type'=>get_class($authorable),
                'authorable_id'=>$authorable->id,
                'notes'=>$notes,
            ]);
        }
        return $instance;
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
        return 'authorables';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Authorables[]|Authorables
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Authorables
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
