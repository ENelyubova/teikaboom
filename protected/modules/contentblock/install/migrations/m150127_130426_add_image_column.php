<?php

class m150127_130426_add_image_column extends \yupe\components\DbMigration
{
    public function up()
    {
        $this->addColumn('{{contentblock_content_block}}', 'image', 'string default NULL');
    }

    public function down()
    {
        $this->dropColumn('{{contentblock_content_block}}', 'image');
    }
}