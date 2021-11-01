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
class m180422_142417_add_table_category extends yupe\components\DbMigration
{
    /**
     * Функция настройки и создания таблицы:
     *
     * @return null
     **/
    public function safeUp()
    {
        $this->createTable(
            '{{news_category}}',
            [
                'id'              => 'pk',
                'create_user_id'  => "integer NOT NULL",
                'update_user_id'  => "integer NOT NULL",
                'create_time'     => 'datetime NOT NULL',
                'update_time'     => 'datetime NOT NULL',
                'name_short'      => 'string COMMENT "Короткое Название"',
                'name'            => 'string COMMENT "Название"',
                'slug'            => 'string COMMENT "Slug"',
                'description'     => 'text COMMENT "Описание"',
                'icon'            => 'string COMMENT "Иконка"',
                'image'           => 'string COMMENT "Изображение"',
                'seo_title'       => 'varchar(250) COMMENT "Title (SEO)"',
                'seo_keywords'    => 'text COMMENT "Ключевые слова (SEO)"',
                'seo_description' => 'text COMMENT "Описание (SEO)"',
                'status'          => 'integer COMMENT "Статус"',
                'position'        => 'integer COMMENT "Сортировка"',
            ],
            $this->getOptions()
        );
    }

    /**
     * Функция удаления таблицы:
     *
     * @return null
     **/
    public function safeDown()
    {
        $this->dropTableWithForeignKeys('{{news_category}}');
    }
}
