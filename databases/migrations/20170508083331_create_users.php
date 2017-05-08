<?php

use Phinx\Migration\AbstractMigration;

class CreateUsers extends AbstractMigration
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
        $this->table('users')
            ->addColumn('name','string',['comment'=>'登录名称'])
            ->addColumn('password','string',['comment'=>'登录密码'])
            ->addColumn('email','string',['comment'=>'登录邮件'])
            ->addColumn('remember_token','string',['comment'=>'校对自动登录时token是否最新','null'=>'NULL'])
            ->addColumn('notes','string',['comment'=>'注释说明','null'=>'NULL'])
            ->addTimestamps()
            ->create();
    }
}
