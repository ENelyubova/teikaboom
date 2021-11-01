<?php

class m180421_142417_add_column_park extends yupe\components\DbMigration
{
    public function safeUp()
    {
        $this->addColumn('{{news_news}}', 'trc_id', 'integer DEFAULT NULL');
        $this->addColumn('{{news_news}}', 'type_news', 'string');
    }
}