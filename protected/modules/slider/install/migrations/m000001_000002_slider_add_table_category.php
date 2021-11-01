<?php

class m000001_000002_slider_add_table_category extends yupe\components\DbMigration
{
	public function safeUp()
	{
		$this->addColumn('{{slider}}', 'category_id', 'integer');
		
        $this->createTable(
            '{{slider_category}}',
            [
                'id'                => 'pk',
                'name'              => 'string COMMENT "Название"',
                'status'            => 'integer COMMENT "Статус"',
                'position'          => 'integer COMMENT "Сортировка"',
            ],
            $this->getOptions()
        );

        $this->addForeignKey(
            "fk_{{slider}}_category_id",
            '{{slider}}',
            'category_id',
            '{{slider_category}}',
            'id',
            'CASCADE',
            'CASCADE'
        );
	}

	public function safeDown()
	{
		$this->dropTableWithForeignKeys('{{slider_category}}');
	}
}