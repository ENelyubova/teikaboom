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
class m000000_000001_masterclass_image extends yupe\components\DbMigration
{
    public function safeUp()
    {
        $this->createTable(
            '{{masterclass_image}}',
            [
                'id'             => 'pk',
                'masterclass_id' => 'integer DEFAULT NULL',
                'image'          => 'string COMMENT "Изображение" DEFAULT NULL',
                'title'          => 'string COMMENT "Название изображения" DEFAULT NULL',
                'alt'            => 'string COMMENT "Alt изображения" DEFAULT NULL',
                'description'    => 'string COMMENT "Описание изображения" DEFAULT NULL',
                'position'       => 'integer COMMENT "Сортировка"',
            ],
            $this->getOptions()
        );
        $this->addForeignKey(
            "fk_{{masterclass_image}}_masterclass_id",
            '{{masterclass_image}}',
            'masterclass_id',
            '{{masterclass}}',
            'id',
            'CASCADE',
            'CASCADE'
        );
        
    }
}