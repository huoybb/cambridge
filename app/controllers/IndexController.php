<?php

class IndexController extends \core\myController
{

    public function indexAction()
    {
//        $only = [
//            'index','name','url','story','list_id'=>'等级','douban_id'=>'豆瓣ID','baiduyun'=>'百度云'
//        ];
//        $lables = array_values($only);
//        $keys = array_keys($only);
//
//        foreach($keys as $index=>$value){
//            if(is_int($value)) $keys[$index] = $lables[$index];
//        }
//        var_dump($lables,$keys);
//
//        var_dump(in_array('douban_id',$only));
//        var_dump(array_key_exists('douban_id',$only));
//        dd();

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

    protected function getbookpostersAndstripAuthor()
    {
        foreach (Books::find() as $book) {
            $image = file_get_contents($book->img);
            $filename = 'images/' . basename($book->img);
            file_put_contents($filename, $image);
        }
        foreach(Books::find() as $book){
            $book->save(['author'=>trim(preg_replace('%\s*<img src="images/author\.png">%sim', '', $book->author))]);
        }
    }

}

