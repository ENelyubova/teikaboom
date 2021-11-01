<?php

class m180421_143326_add_column_body_Short extends yupe\components\DbMigration
{
	public function safeUp()
	{
        $this->addColumn('{{page_page}}', 'body_short', 'text');
	}

	public function safeDown()
	{
        $this->dropColumn('{{page_page}}', 'body_short');
	}
}