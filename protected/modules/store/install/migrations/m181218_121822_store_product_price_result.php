<?php

Yii::import('application.modules.store.models.Product');

class m181218_121822_store_product_price_result extends yupe\components\DbMigration
{
    public function safeUp()
    {
        $this->addColumn('{{store_product}}', 'price_result', 'decimal(19,3)');

        foreach (Product::model()->findAll() as $key => $product) {
        	$product->price_result = $product->getResultPrice();
        	$product->save(false);
        }
    }

    public function safeDown()
    {
        $this->dropColumn('{{store_product}}', 'price_result');
    }
}