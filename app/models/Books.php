<?php

class Books extends \core\myModel
{
    use CommentableTrait;
    use \core\myPresenterTrait;
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
     * @var string
     * @Column(type="string", length=255, nullable=false)
     */
    public $img;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=false)
     */
    public $url;

    /**
     *
     * @var string
     * @Column(type="string", nullable=false)
     */
    public $info;

    /**
     *
     * @var string
     * @Column(type="string", nullable=false)
     */
    public $story;

    /**
     *
     * @var string
     * @Column(type="string", nullable=false)
     */
    public $author;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    public $list_id;

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

    public static function findByList(Lists $list)
    {
        return static::query()
            ->where('list_id = :list:',['list'=>$list->id])
            ->execute();
    }

    public static function findByAuthor(Authors $author)
    {
        return static::query()
            ->leftJoin(Authorables::class,'au.authorable_type = "Books" AND au.authorable_id = Books.id','au')
            ->where('au.author_id = :author:',['author'=>$author->id])
            ->execute();
    }

    public static function findByKeywords($keywords)
    {
        return static::query()
            ->where('name like :keywords:',['keywords'=>'%'.$keywords.'%'])
            ->execute();
    }

    /**
     * @param $key
     * @return Books
     */
    public static function findByBlcupKey($key)
    {
        $url = "http://www.blcup.com/PInfo/index/$key";
        $instance = static::query()
            ->where('url = :url:',['url'=>$url])
            ->execute()->getFirst();
        if(!$instance)  {
            $data = \webParser\blcup::getBookInfo($url);
            $name =  preg_replace('/（.*?）/im', '',$data['name']);
            $instance =static::findByKeywords($name)->getFirst();
            if(!$instance){
                $instance = static::saveNew($data);
            }else{
                $instance->save($data);
            }
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
        return 'books';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Books[]|Books
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Books
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

    public function updateBidAndLevelID()
    {
        if (preg_match('/bid=([0-9]+)&levelid=([0-9]+)/sim', $this->url, $regs)) {
            $this->bid = $regs[1];
            $this->levelid = $regs[2];
            $this->save();
        }
    }
    public function chapters()
    {
        return $this->make('chapters',function(){
            return Chapters::findByBook($this);
        });
    }
    public function list()
    {
        return $this->make('list',function(){
            return Lists::findFirst($this->list_id);
        });
    }

    public function img()
    {
        return '/images/'.basename($this->img);
    }

    /**
     * $data=[
            'author'=>$regs[1],
            'author_intr'=>$regs[2],
            'translator'=>$regs[3],
            'translator_intr'=>$regs[4],
        ];
     * @param $data
     */
    public function addAuthor($data)
    {
        if(isset($data['author'])){
            $row = [
                'name'=>$data['author'],
                'notes'=>'作者',
                'authorable'=>$this,
            ];
            if(isset($data['author_intr'])) $row['intr']=$data['author_intr'];

            Authors::findOrNew($row);
        }
        if(isset($data['translator'])){
            Authors::findOrNew([
                'name'=>$data['translator'],
                'intr'=>$data['translator_intr'],
                'notes'=>'译者',
                'authorable'=>$this,
            ]);
        }
    }
    public function authors()
    {
        return $this->make('authors',function(){
            return Authors::findByBook($this);
        });
    }
    public function author()
    {
        $results = [];
        foreach($this->authors() as $author){
            if($author->authorable->notes == '作者') $results[]=$author;
        }
        return collect($results);
    }
    public function translator()
    {
        $results = [];
        foreach($this->authors() as $author){
            if($author->authorable->notes == '译者') $results[]=$author;
        }
        return collect($results);
    }

    public function answer_url()
    {
        return "http://static2.iyuba.com/camstory/answer/{$this->levelid}_{$this->bid}.pdf";
    }
    public function teachplan_url()
    {
        return "http://static2.iyuba.com/camstory/teachingplan/{$this->levelid}_{$this->bid}.pdf";
    }

    public function douban()
    {
        if($this->douban_id){
            return "https://book.douban.com/subject/{$this->douban_id}/";
        }
        if($isbn = $this->present('ISBN')){
            return "https://book.douban.com/subject_search?search_text={$isbn}";
        }
        return "https://book.douban.com/subject_search?search_text={$this->keywords()}";
    }

    private function keywords()
    {
        $this->author()->implode('name',' ');
        return preg_replace('/[^u4e00-^u9fa5\s]+/sim', '',$this->name) .' '. $this->author()->implode('name',' ');
    }
    private function name_zh()
    {
        return preg_replace('/([^u4e00-^u9fa5]+)[a-zA-Z]+.*/sim', '$1',$this->name);
    }

    public function addResources($path = null)
    {
        if($path == null) $path = $this->rescourcePath();
        $files = scandir($this->resourceRealPath($path));
        foreach($files as $file){
            if($file == '.' || $file == '..') continue;
            if (preg_match('/([0-9]+)\s*(.*?).mp3/sim', $file, $regs)) {
                [$filename,$index,$name] = $regs;
                $filename = $path.$filename;
                $this->addChapter(compact('index','name','filename'));
            }
        }
        return $this;
    }

    /**
     * @param $data
     * @return Chapters
     */
    public function addChapter($data)
    {
        $data = array_merge($data,[
            'book_id'=>$this->id,
        ]);
        $instance = Chapters::findByfilename($data['filename']);
        if(!$instance) $instance = Chapters::saveNew($data);
        return $instance;
    }

    public function rescourcePath()
    {
        return $path = '/resources/'.$this->present('ISBN').'/';
    }
    public function resourceRealPath($relativePath = null)
    {
        if($relativePath == null) $relativePath = $this->rescourcePath();
        return BASE_PATH.'/public'.$relativePath;
    }

    public function getResource($keywords)
    {
        if(is_dir($this->resourceRealPath())){
            $files = scandir($this->resourceRealPath());
            foreach($files as $filename){
                if (preg_match('/^.*'.$keywords.'.pdf\Z/im', $filename)) {
                    return $this->rescourcePath().$filename;
                }
            }
        }
        return null;
    }

    public function blcup()
    {
        return "http://www.blcup.com/PList?_content={$this->name_zh()}";
    }



}
