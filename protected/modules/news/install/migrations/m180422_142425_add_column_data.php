<?php

class m180422_142425_add_column_data extends yupe\components\DbMigration
{
    public function safeUp()
    {
        $this->addColumn('{{news_news}}', 'data', 'longtext');

        $this->createTable(
            '{{news_image}}',
            [
                'id'           => 'pk',
                'news_id'      => 'integer DEFAULT NULL',
                'image'        => 'string COMMENT "Изображение" DEFAULT NULL',
                'title'        => 'string COMMENT "Название изображения" DEFAULT NULL',
                'alt'          => 'string COMMENT "Alt изображения" DEFAULT NULL',
                'description'  => 'string COMMENT "Описание изображения" DEFAULT NULL',
                'position'     => 'integer COMMENT "Сортировка"',
            ],
            $this->getOptions()
        );
        $this->addForeignKey(
            "fk_{{news_image}}_news_id",
            '{{news_image}}',
            'news_id',
            '{{news_news}}',
            'id',
            'CASCADE',
            'CASCADE'
        );
        
    }
}