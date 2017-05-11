<?php

class IndexController extends \core\myController
{

    public function indexAction()
    {
//        foreach(Books::find() as $book){
//            preg_match('%^<h3>作者简介</h3>\s*<h4>(.+?)</h4>\s*<p>(.+?)</p>\s+<h4>(.+?)</h4>\s*<p>(.+?)</p>$%sim', $book->author, $regs);
//            $data=[
//                'author'=>$regs[1],
//                'author_intr'=>$regs[2],
//                'translator'=>$regs[3],
//                'translator_intr'=>$regs[4],
//            ];
//            $book->addAuthor($data);
//        }
//        foreach (Books::find() as $book){
//            echo $book->teachplan_url().'<br>';
//        }
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

