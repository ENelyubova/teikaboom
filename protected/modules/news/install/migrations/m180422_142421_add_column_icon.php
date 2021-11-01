<?php

class m180422_142421_add_column_icon extends yupe\components\DbMigration
{
    public function safeUp()
    {
        $this->addColumn('{{news_news}}', 'icon', 'string');
    }
}