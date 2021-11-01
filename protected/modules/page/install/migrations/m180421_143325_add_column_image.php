<?php

class m180421_143325_add_column_image extends yupe\components\DbMigration
{
	public function safeUp()
	{
        $this->addColumn('{{page_page}}', 'image', 'varchar(250)');
        $this->addColumn('{{page_page}}', 'icon', 'varchar(250)');
	}

	public function safeDown()
	{
        $this->dropColumn('{{page_page}}', 'image');
        $this->dropColumn('{{page_page}}', 'icon');
	}
}