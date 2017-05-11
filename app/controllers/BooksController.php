<?php

/**
 * Created by PhpStorm.
 * User: ThinkPad
 * Date: 2017/5/7
 * Time: 17:53
 */
class BooksController extends \core\myController
{
    public function showAction(Books $book)
    {
        $this->view->setVars(compact('book'));
    }
    public function editAction(Books $book)
    {
        if($this->request->isPost()){
            $book->save($this->request->getPost());
            return $this->redirectBack();
        }
        $this->view->setVars(compact('book'));
    }


    public function addAuthorAction(Books $book)
    {
        if($this->request->isPost()){
            $book->addAuthor(['author'=>$this->request->getPost('name')]);
            return $this->redirectBack();
        }
        $this->view->setVars(compact('book'));
    }

}