<?php

class m180422_142422_add_column_seo_title_h1 extends yupe\components\DbMigration
{
    public function safeUp()
    {
        $this->addColumn('{{news_category}}', 'title', 'string');
    }
}