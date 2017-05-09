<?php

use Phinx\Migration\AbstractMigration;

class ModifyLists extends AbstractMigration
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
            ->addColumn('grade','string',['comment'=>'推荐年级（词汇量）','null'=>'NULL'])
            ->addColumn('cef','string',['comment'=>'CEF,分级标准：欧洲共同语言参考框架（CEF）','null'=>'NULL'])
            ->addColumn('esol','string',['comment'=>'ESOL，剑桥大学外语考试部（ESOL）的“剑桥五级考试”','null'=>'NULL'])
            ->update();
    }
}
