<?php
/**
 * Park install migration
 * Класс миграций для модуля Park:
 *
 * @category YupeMigration
 * @package  yupe.modules.park.install.migrations
 * @author   YupeTeam <team@yupe.ru>
 * @license  BSD https://raw.github.com/yupe/yupe/master/LICENSE
 * @link     http://yupe.ru
 **/
class m000000_000005_park_add_column_parent_id extends yupe\components\DbMigration
{
    public function safeUp()
    {
        $this->addColumn('{{park_page}}', 'parent_id', 'integer');
    }

    public function safeDown()
    {
        $this->dropColumn('{{park_page}}', 'parent_id');
    }
}
