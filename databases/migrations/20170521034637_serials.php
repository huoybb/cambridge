<?php

use Phinx\Migration\AbstractMigration;

class Serials extends AbstractMigration
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
        $this->table('serials')
            ->addColumn('name','string',['comment'=>'系列图书的名称'])
            ->addColumn('url','string',['comment'=>'系列图书的原版地址url'])
            ->addColumn('description','text',['comment'=>'系列的介绍'])
            ->addTimestamps()
            ->create();
    }
}
