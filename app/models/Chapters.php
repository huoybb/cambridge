<?php

class Chapters extends \core\myModel
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
    public $index;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=false)
     */
    public $name;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    public $book_id;

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

    public static function findByBook(Books $book)
    {
        return static::query()
            ->where('book_id = :book:',['book'=>$book->id])
            ->execute();
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
        return 'chapters';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Chapters[]|Chapters
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Chapters
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }
    public function book()
    {
        return Books::findFirst($this->book_id);
    }
    public function mp3_url()
    {
        $book = $this->book();
        $levelid = $book->levelid;
        $bid = $book->bid;
        $cid = $this->index - 1;
        return "http://static2.iyuba.com/camstory/sound/{$levelid}_{$bid}_{$cid}.mp3";
    }
    public function mp3()
    {
        $book = $this->book();
        $levelid = $book->levelid;
        $bid = $book->bid;
        $cid = $this->index - 1;
        return "/sounds/{$levelid}_{$bid}_{$cid}.mp3";
    }



}
