<?php

class m180422_142420_update_column_trc_id extends yupe\components\DbMigration
{
    public function safeUp()
    {
        $this->renameColumn('{{news_news}}', 'trc_id', 'park_id');
    }
}