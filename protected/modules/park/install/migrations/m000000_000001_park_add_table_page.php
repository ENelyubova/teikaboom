
<?php
/**
 * Park install migration
 * Класс миграций для модуля Park:
 *
 * @category YupeMigration
 * @package  yupe.modules.park.install.migrations
 * @author   YupeTeam <team@yupe.ru>
 * @license  BSD https://raw.github.com/yupe/yupe/master/LICENSE
 * @link     https://yupe.ru
 **/
class m000000_000001_park_add_table_page extends yupe\components\DbMigration
{
    /**
     * Функция настройки и создания таблицы:
     *
     * @return null
     **/
    public function safeUp()
    {
        $this->createTable(
            '{{park_page}}',
            [
                'id'             => 'pk',
                //для удобства добавлены некоторые базовые поля, которые могут пригодиться.
                'create_user_id'    => "integer NOT NULL",
                'update_user_id'    => "integer NOT NULL",
                'create_time'       => 'datetime NOT NULL',
                'update_time'       => 'datetime NOT NULL',
                'park_id'           => 'integer COMMENT "Парк" NOT NULL',
                'name_short'        => 'string COMMENT "Короткое Название" NOT NULL',
                'name'              => 'string COMMENT "Название" NOT NULL',
                'slug'              => 'string COMMENT "Alias" NOT NULL',
                'image'             => 'varchar(150) COMMENT "Изображение"',
                'description_short' => 'text COMMENT "Короткое описание"',
                'description'       => 'text COMMENT "Описание"',
                'title'             => 'string COMMENT "Заголовок (H1)"',
                'meta_title'        => 'string COMMENT "Title (SEO)"',
                'meta_keywords'     => 'text COMMENT "Ключевые слова SEO"',
                'meta_description'  => 'text COMMENT "Описание SEO"',
                'position'          => 'integer COMMENT "Сортировка"',
                'status'            => 'integer DEFAULT "0" COMMENT "Статус"',
            ],
            $this->getOptions()
        );

        $this->addForeignKey(
            "fk_{{park}}_park_id",
            '{{park_page}}',
            'park_id',
            '{{park}}',
            'id',
            'CASCADE',
            'CASCADE'
        );

    }

    /**
     * Функция удаления таблицы:
     *
     * @return null
     **/
    public function safeDown()
    {
        $this->dropTableWithForeignKeys('{{park}}');
    }
}
