<?php
/**
 * Created by PhpStorm.
 * User: ThinkPad
 * Date: 2016/7/2
 * Time: 16:29
 */

use Phalcon\Di;

trait CommentableTrait
{
    public function getComments()
    {
        /** @var \core\myModel $this */
        return $this->make('comments',function(){
            /** @var \core\myModel $this */
            return Comments::findByCommentedObject($this);
        });
    }

    public function hasComments()
    {
        return $this->getComments()->count();
    }
    public function addComment(array $data)
    {
        /** @var \core\myModel $this */
        $data = array_merge($data,[
            'user_id'=>auth()->user()->id,
            'commentable_type'=>get_class($this),
            'commentable_id'=>$this->id,
        ]);
        Comments::saveNew($data);
        return $this;
    }
    public function getCommentForm()
    {
        return (new Comments)->getForm();
    }


}