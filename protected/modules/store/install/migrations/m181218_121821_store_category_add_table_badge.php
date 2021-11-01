<?php

class m181218_121821_store_category_add_table_badge extends yupe\components\DbMigration
{
    public function safeUp()
    {
        $this->createTable(
            '{{store_badge}}',
            [
                'id'                => 'pk',
                'name'              => 'string COMMENT "Название"',
                'color'             => 'string COMMENT "Цвет текста"',
                'background'        => 'text COMMENT "Фон Badge"',
                'status'            => 'integer COMMENT "Статус"',
                'position'          => 'integer COMMENT "Сортировка"',
            ],
            $this->getOptions()
        );
        $this->createTable(
            '{{store_product_badge}}',
            [
                'id'         => 'pk',
                'badge_id'   => 'integer COMMENT "Id Badge" default null',
                'product_id' => 'integer COMMENT "Id продукта" default null',
            ],
            $this->getOptions()
        );

        $this->addForeignKey("fk_{{store_product_badge}}_badge_id", 
        	"{{store_product_badge}}", 
        	"badge_id", 
        	"{{store_badge}}", 
        	"id", 
        	"CASCADE", 
        	"CASCADE"
        );
        $this->addForeignKey("fk_{{store_product_badge}}_product_id", 
        	"{{store_product_badge}}", 
        	"product_id", 
        	"{{store_product}}", 
        	"id",
        	"CASCADE", 
        	"CASCADE"
        );
    }

    public function safeDown()
    {
        $this->dropTableWithForeignKeys("{{store_badge}}");
        $this->dropTableWithForeignKeys("{{store_product_badge}}");
    }
}