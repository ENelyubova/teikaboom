<?php
/**
 *
 **/
class m000000_000013_park_add_kitchen extends yupe\components\DbMigration
{
    public function safeUp()
    {
        $this->addColumn('{{park}}', 'kitchen', 'string');
    }

    public function safeDown()
    {
        $this->dropColumn('{{park}}', 'kitchen');
    }
}
