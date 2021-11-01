<?php

/**
 *
 * Mail install migration
 * Класс миграций для модуля Mail
 *
 * @category YupeMigration
 * @package  yupe.modules.install.migrations
 * @author   YupeTeam <team@yupe.ru>
 * @license  BSD https://raw.github.com/yupe/yupe/master/LICENSE
 * @link     https://yupe.ru
 **/
class m000000_000001_mail_order_base extends yupe\components\DbMigration
{
    public function safeUp()
    {
        /**
         * mail_event:
         **/
        $this->createTable(
            '{{mail_mail_order}}',
            [
                'id'      => 'pk',
                'theme'   => 'varchar(255) COMMENT "Тема"',
                'name'    => 'varchar(255) COMMENT "Имя"',
                'phone'   => 'varchar(255) COMMENT "Телефон"',
                'email'   => 'varchar(255) COMMENT "E-mail"',
                'comment' => 'text COMMENT "Сообщение"',
                'data'    => 'text COMMENT "Данные"',
                'group'   => 'string COMMENT "Группа"',
                'status'  => 'integer COMMENT "Статус"',
            ],
            $this->getOptions()
        );
    }

    public function safeDown()
    {
        $this->dropTableWithForeignKeys('{{mail_mail_order}}');
    }
}
