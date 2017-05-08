<?php

use Phinx\Migration\AbstractMigration;

class CreateComments extends AbstractMigration
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
        $this->table('comments')
            ->addColumn('content','text',['comment'=>'评论的内容'])
            ->addColumn('commentable_type','string',['comment'=>'被评论的对象类型'])
            ->addColumn('commentable_id','integer',['comment'=>'被评论的对象的ID'])
            ->addColumn('user_id','integer',['comment'=>'谁进行的评论？'])
            ->addTimestamps()
            ->create();
    }
}
