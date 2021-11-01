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
class m000000_000008_park_add_map_code extends yupe\components\DbMigration
{
    public function safeUp()
    {
        $this->addColumn('{{park}}', 'map_code', 'text');
    }

    public function safeDown()
    {
        $this->dropColumn('{{park}}', 'map_code');
    }
}
