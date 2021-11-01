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
class m000000_000006_park_add_slug_uniqi extends yupe\components\DbMigration
{
    public function safeUp()
    {
        $this->createIndex("ux_{{park_page}}_slug_city", '{{park_page}}', "slug,park_id", true);
    }
}
