<?php
/**
 * Masterclass install migration
 * Класс миграций для модуля Masterclass:
 *
 * @category YupeMigration
 * @package  yupe.modules.masterclass.install.migrations
 * @author   YupeTeam <team@yupe.ru>
 * @license  BSD https://raw.github.com/yupe/yupe/master/LICENSE
 * @link     https://yupe.ru
 **/
class m000000_000000_masterclass_base extends yupe\components\DbMigration
{
    /**
     * Функция настройки и создания таблицы:
     *
     * @return null
     **/
    public function safeUp()
    {
        $this->createTable(
            '{{masterclass}}',
            [
                'id'             => 'pk',
                //для удобства добавлены некоторые базовые поля, которые могут пригодиться.
                'create_user_id' => "integer NOT NULL",
                'update_user_id' => "integer NOT NULL",
                'create_time'    => 'datetime NOT NULL',
                'update_time'    => 'datetime NOT NULL',
                'date'           => 'date NOT NULL',
                'theme_id'          => 'integer COMMENT "Тема мастер класса" NOT NULL',
                'name_short'        => 'string COMMENT "Короткое Название" NOT NULL',
                'name'              => 'string COMMENT "Название" NOT NULL',
                'slug'              => 'string COMMENT "Alias" NOT NULL',
                'image'             => 'varchar(150) COMMENT "Изображение"',
                'price'             => 'decimal(19,3) not null default "0" COMMENT "Стоимость"',
                'duration'          => 'varchar(150) COMMENT "Продолжительность"',
                'age'               => 'varchar(150) COMMENT "Возрастная категория"',
                'description_short' => 'text COMMENT "Короткое описание"',
                'description'       => 'text COMMENT "Описание"',
                'title'             => 'string COMMENT "Заголовок (H1)"',
                'meta_title'        => 'string COMMENT "Title (SEO)"',
                'meta_keywords'     => 'text COMMENT "Ключевые слова SEO"',
                'meta_description'  => 'text COMMENT "Описание SEO"',
                'position'          => 'integer COMMENT "Сортировка"',
                'status'            => 'integer DEFAULT "0" COMMENT "Статус"',
                'data'              => 'longtext',
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
        $this->dropTableWithForeignKeys('{{masterclass}}');
    }
}
