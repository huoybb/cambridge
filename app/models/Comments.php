<?php

use core\myModel;

class Comments extends myModel
{
    use \core\myPresenterTrait;

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=10, nullable=false)
     */
    public $id;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    public $content;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=true)
     */
    public $commentable_id;

    /**
     *
     * @var string
     * @Column(type="string", length=100, nullable=true)
     */
    public $commentable_type;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    public $created_at;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    public $updated_at;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=true)
     */
    public $user_id;

    public static function findByUser(Users $user)
    {
        return static::query()
            ->where('user_id = :user:',['user'=>$user->id])
            ->orderBy('created_at DESC')
            ->execute();
    }

    public static function findByCommentedObject(myModel $object)
    {
        return static::query()
            ->where('commentable_type = :type:',['type'=>get_class($object)])
            ->andWhere('commentable_id = :id:',['id'=>$object->id])
            ->orderBy('created_at DESC')
            ->execute();
    }
    public static function latest(){
        return static::query()
            ->orderBy('updated_at DESC')
            ->limit(10)
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
        return 'comments';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Comments[]|Comments
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Comments
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

    public function commentable()
    {
        return $this->make('commentable',function(){
            $class = $this->commentable_type;
            return $class::findFirst($this->commentable_id);
        });
    }
    public function user()
    {
        return $this->make('user',function(){
            return Users::findFirst($this->user_id);
        });
    }
    public function infoArray()
    {
        return [
            'content'=>'内容',
            'commentable'=>'评论对象',
            'user'=>'评论者'
        ];
    }




}
