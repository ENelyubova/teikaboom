<?php
/**
 * Directions install migration
 * Класс миграций для модуля Directions:
 *
 **/
class m180421_143331_add_column_page_image_desc extends yupe\components\DbMigration
{
    /**
     * Функция настройки и создания таблицы:
     *
     * @return null
     **/
    public function safeUp()
    {
        $this->addColumn('{{page_page_image}}', 'description', 'text');
    }

    /**
     * Функция удаления таблицы:
     *
     * @return null
     **/
    public function safeDown()
    {
        $this->dropColumn('{{page_page_image}}', 'description');
    }
}
