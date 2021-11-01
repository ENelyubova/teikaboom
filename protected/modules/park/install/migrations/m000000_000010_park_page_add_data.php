<?php
/**
 *
 **/
class m000000_000010_park_page_add_data extends yupe\components\DbMigration
{
    public function safeUp()
    {
        $this->addColumn('{{park}}', 'data', 'longtext');
        $this->addColumn('{{park_page}}', 'data', 'longtext');
    }

    public function safeDown()
    {
        $this->dropColumn('{{park_page}}', 'data');
    }
}
