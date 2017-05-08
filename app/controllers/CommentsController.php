<?php

/**
 * Created by PhpStorm.
 * User: ThinkPad
 * Date: 2017/3/19
 * Time: 17:13
 */
class CommentsController extends \core\myController
{
    public function indexAction()
    {
        $this->view->comments = Comments::latest();
    }

    public function addAction($commentable_type,$commentable_id)
    {
        /** @var CommentableTrait $commentable */
        $commentable = $commentable_type::findFirst($commentable_id);
        if(!$commentable) throw new Exception("资源没有找到：{$commentable_type}::{$commentable_id}");
        $commentable->addComment($this->request->getPost());

        return $this->destroyUrlBeforeVariable()->redirectBack();
    }
    public function editAction(Comments $comment)
    {
        if($this->request->isPost()){
            $comment->save($this->request->getPost());
            return $this->redirectBack();
        }
        $this->view->comment = $comment;
    }
    public function deleteAction(Comments $comment)
    {
        if($this->request->isPost() && $this->request->get('confirm')){
            $comment->delete();
            return $this->redirectBack();
        }
        $this->view->comment = $comment;
    }


}