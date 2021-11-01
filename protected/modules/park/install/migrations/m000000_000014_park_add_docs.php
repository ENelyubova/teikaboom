<?php
/**
 *
 **/
class m000000_000014_park_add_docs extends yupe\components\DbMigration
{
    public function safeUp()
    {
        $this->addColumn('{{park}}', 'docs', 'string');
    }

    public function safeDown()
    {
        $this->dropColumn('{{park}}', 'docs');
    }
}
