<?php

use Phinx\Migration\AbstractMigration;

class CreateAuthors extends AbstractMigration
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
        $this->table('authors')
            ->addColumn('name','string',['comment'=>'作者姓名'])
            ->addColumn('intr','text',['comment'=>'作者介绍'])
            ->addTimestamps()
            ->create();
        $this->table('authorables')
            ->addColumn('author_id','integer',['comment'=>'作者是谁？'])
            ->addColumn('notes','string',['comment'=>'作者 vs 译者'])
            ->addColumn('authorable_type','string',['comment'=>'图书或者别的作品的类型'])
            ->addColumn('authorable_id','integer',['comment'=>'图书或者别的作品的ID'])
            ->addTimestamps()
            ->create();
    }
}
