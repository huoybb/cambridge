<?php

class IndexController extends \core\myController
{

    public function indexAction()
    {
        $this->view->lists = Lists::find();
    }

    protected function getListAndBookFromWeb()
    {
        $data = \webParser\Camstory::getBooklist();
        var_dump($data);
        foreach ($data['listNames'] as $key => $name) {
            Lists::saveNew(['index' => $key + 1, 'name' => $name]);
        }
        foreach ($data['booklist'] as $key => $books) {
            $list = Lists::findByIndex($key + 1);
            foreach ($books as $key2 => $book) {
                $book['index'] = $key2 + 1;
                $list->addBook($book);
            }
        }
        foreach(Books::find() as $book){
            $book->updateBidAndLevelID();
        }
    }

    protected function getBookInfo()
    {
        foreach (Books::query()->where('id > :id:', ['id' => 41])->execute() as $book) {
            $data = \webParser\Camstory::getBookInfo($book->url);
            $book->save($data);
            foreach ($data['chapters'] as $chapter) {
                $chapter['book_id'] = $book->id;
                Chapters::saveNew($chapter);
            }
            sleep(random_int(1, 5));
        }

    }

}

