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
class m000000_000004_park_add_table_image extends yupe\components\DbMigration
{
    /**
     * @return null
     **/
    public function safeUp()
    {
        $this->createTable(
            '{{park_image}}',
            [
                'id'           => 'pk',
                'park_id'      => 'integer DEFAULT NULL',
                'image'        => 'string COMMENT "Изображение" DEFAULT NULL',
                'title'        => 'string COMMENT "Название изображения" DEFAULT NULL',
                'alt'          => 'string COMMENT "Alt изображения" DEFAULT NULL',
                'description'  => 'string COMMENT "Описание изображения" DEFAULT NULL',
                'position'     => 'integer COMMENT "Сортировка"',
            ],
            $this->getOptions()
        );
        $this->addForeignKey(
            "fk_{{park_image}}_park_id",
            '{{park_image}}',
            'park_id',
            '{{park}}',
            'id',
            'CASCADE',
            'CASCADE'
        );
        
        $this->createTable(
            '{{park_page_image}}',
            [
                'id'                 => 'pk',
                'park_page_id' => 'integer DEFAULT NULL',
                'image'              => 'string COMMENT "Изображение" DEFAULT NULL',
                'title'              => 'string COMMENT "Название изображения" DEFAULT NULL',
                'alt'                => 'string COMMENT "Alt изображения" DEFAULT NULL',
                'description'        => 'string COMMENT "Описание изображения" DEFAULT NULL',
                'position'           => 'integer COMMENT "Сортировка"',
            ],
            $this->getOptions()
        );
        $this->addForeignKey(
            "fk_{{park_page_image}}_park_page_id",
            '{{park_page_image}}',
            'park_page_id',
            '{{park_page}}',
            'id',
            'CASCADE',
            'CASCADE'
        );
    }
}
