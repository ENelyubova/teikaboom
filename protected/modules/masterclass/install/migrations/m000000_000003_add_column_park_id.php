<?php

class m000000_000003_add_column_park_id extends yupe\components\DbMigration
{
    public function safeUp()
    {
        $this->addColumn('{{masterclass}}', 'park_id', 'integer');
    }
}