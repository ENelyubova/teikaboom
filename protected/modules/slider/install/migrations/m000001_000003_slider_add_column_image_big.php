<?php

class m000001_000003_slider_add_column_image_big extends yupe\components\DbMigration
{
	public function safeUp()
	{
        $this->addColumn('{{slider}}', 'image_big', 'varchar(250)');
	}

	public function safeDown()
	{
        $this->dropColumn('{{slider}}', 'image_big');
	}
}