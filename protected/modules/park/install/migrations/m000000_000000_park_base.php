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
class m000000_000000_park_base extends yupe\components\DbMigration
{
    /**
     * Функция настройки и создания таблицы:
     *
     * @return null
     **/
    public function safeUp()
    {
        $this->createTable(
            '{{park}}',
            [
                'id'             => 'pk',
                //для удобства добавлены некоторые базовые поля, которые могут пригодиться.
                'create_user_id'    => "integer NOT NULL",
                'update_user_id'    => "integer NOT NULL",
                'create_time'       => 'datetime NOT NULL',
                'update_time'       => 'datetime NOT NULL',
                'name_short'        => 'string COMMENT "Короткое Название"',
                'name'              => 'string COMMENT "Название"',
                'slug'              => 'string COMMENT "Alias"',
                'image'             => 'varchar(150) COMMENT "Изображение"',
                'description_short' => 'text COMMENT "Короткое описание"',
                'description'       => 'text COMMENT "Описание"',
                'mode'              => 'string COMMENT "График работы"',
                'phone'             => 'string COMMENT "Телефон"',
                'email'             => 'string COMMENT "E-nail"',
                'address'           => 'text COMMENT "Адрес"',
                'coords'            => 'varchar(150) COMMENT "Координаты на карте"',
                'subway_station'    => 'text COMMENT "Станция метро"',
                'how_to_get'        => 'text COMMENT "Как добраться"',
                'back'              => 'string COMMENT "Цвет фона"',
                'title'             => 'string COMMENT "Заголовок (H1)"',
                'meta_title'        => 'string COMMENT "Title (SEO)"',
                'meta_keywords'     => 'text COMMENT "Ключевые слова SEO"',
                'meta_description'  => 'text COMMENT "Описание SEO"',
                'position'          => 'integer COMMENT "Сортировка"',
                'status'            => 'integer DEFAULT "0" COMMENT "Статус"',
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
        $this->dropTableWithForeignKeys('{{park}}');
    }
}
