<?php

class m180421_143329_add_page_title_page_h1 extends yupe\components\DbMigration
{
	public function safeUp()
	{
        $this->addColumn('{{page_page}}', 'name_h1', 'string');
	}

	public function safeDown()
	{
        $this->dropColumn('{{page_page}}', 'name_h1');
	}
}