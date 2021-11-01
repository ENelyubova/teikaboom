<?php

class m150415_183051_add_column_image extends yupe\components\DbMigration
{
	public function safeUp()
	{
        $this->addColumn('{{dictionary_dictionary_data}}', 'image', 'string');
	}
}