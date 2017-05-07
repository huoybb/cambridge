<?php

use Phinx\Migration\AbstractMigration;

class CreateList extends AbstractMigration
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-abstractmigration-class
     *
     * The following commands can be used in this method and Phinx will
     * automatically reverse them when rolling back:
     *
     *    createTable
     *    renameTable
     *    addColumn
     *    renameColumn
     *    addIndex
     *    addForeignKey
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function change()
    {
        $this->table('lists')
            ->addColumn('index','integer',['comment'=>'序号'])
            ->addColumn('name','string',['comment'=>'系列名称'])
            ->addTimestamps()
            ->create();
        $this->table('books')
            ->addColumn('index','integer',['comment'=>'序号'])
            ->addColumn('name','string',['comment'=>'图书名称'])
            ->addColumn('img','string',['comment'=>'poster'])
            ->addColumn('url','string',['comment'=>'url'])
            ->addColumn('info','text',['comment'=>'相关信息，出版日期等'])
            ->addColumn('story','text',['comment'=>'故事介绍'])
            ->addColumn('author','text',['comment'=>'作者介绍'])
            ->addColumn('list_id','integer',['comment'=>'属于哪个系列的图书？'])
            ->addTimestamps()
            ->create();
        $this->table('chapters')
            ->addColumn('index','integer',['comment'=>'序号'])
            ->addColumn('name','string',['comment'=>'章节名称'])
            ->addColumn('book_id','integer',['comment'=>'属于哪个图书的章节？'])
            ->addTimestamps()
            ->create();

    }
}
