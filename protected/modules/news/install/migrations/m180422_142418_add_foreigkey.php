<?php
/**
 * News install migration
 * Класс миграций для модуля News:
 *
 * @category YupeMigration
 * @package  yupe.modules.document.install.migrations
 * @author   YupeTeam <team@yupe.ru>
 * @license  BSD https://raw.github.com/yupe/yupe/master/LICENSE
 * @link     http://yupe.ru
 **/
class m180422_142418_add_foreigkey extends yupe\components\DbMigration
{
    /**
     * Функция настройки и создания таблицы:
     *
     * @return null
     **/
    public function safeUp()
    {
        $this->dropForeignKey("fk_{{news_news}}_category_id", "{{news_news}}");
        
        $this->addForeignKey("fk_{{news_news}}_category_id", 
            "{{news_news}}", 
            "category_id", 
            "{{news_category}}",
            "id",
            "CASCADE", 
            "CASCADE"
        );
    }

    /**
     * Функция удаления таблицы:
     *
     * @return null
     **/
    public function safeDown()
    {
    }
}
