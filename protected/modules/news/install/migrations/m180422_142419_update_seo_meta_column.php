<?php

class m180422_142419_update_seo_meta_column extends yupe\components\DbMigration
{
    public function safeUp()
    {
        $this->renameColumn('{{news_category}}', 'seo_title', 'meta_title');
        $this->renameColumn('{{news_category}}', 'seo_keywords', 'meta_keywords');
        $this->renameColumn('{{news_category}}', 'seo_description', 'meta_description');
    }
}