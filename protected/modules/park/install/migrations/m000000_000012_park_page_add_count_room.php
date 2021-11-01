<?php
/**
 *
 **/
class m000000_000012_park_page_add_count_room extends yupe\components\DbMigration
{
    public function safeUp()
    {
        $this->addColumn('{{park}}', 'count_room', 'string');
    }

    public function safeDown()
    {
        $this->dropColumn('{{park}}', 'count_room');
    }
}
