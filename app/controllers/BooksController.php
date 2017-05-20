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

    public function deleteAction(Books $book)
    {
        $response = $this->redirect(['for'=>'lists.show','list'=>$book->list_id]);
        $book->delete();
        return $response;
    }



    public function addAuthorAction(Books $book)
    {
        if($this->request->isPost()){
            $book->addAuthor(['author'=>$this->request->getPost('name')]);
            return $this->redirectBack();
        }
        $this->view->setVars(compact('book'));
    }

    public function searchAction($keywords)
    {
        $this->view->books = Books::findByKeywords($keywords);
        $this->view->keywords = $keywords;
    }
    public function getDoubanIDAction($douban_id,$keywords)
    {
        $books = Books::findByKeywords($keywords);
        if($books->count() == 1){
            $books->getFirst()->save(['douban_id'=>$douban_id]);
            return $this->redirect(['for'=>'books.show','book'=>$books->getFirst()->id]);
        }
        var_dump('请检查，看看是否存在重名的图书或者关键词有重复的？');
        dd($books);

    }


}