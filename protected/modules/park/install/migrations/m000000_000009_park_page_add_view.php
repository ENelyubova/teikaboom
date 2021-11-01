<?php
/**
 *
 **/
class m000000_000009_park_page_add_view extends yupe\components\DbMigration
{
    public function safeUp()
    {
        $this->addColumn('{{park_page}}', 'view', 'string');
    }

    public function safeDown()
    {
        $this->dropColumn('{{park_page}}', 'view');
    }
}
