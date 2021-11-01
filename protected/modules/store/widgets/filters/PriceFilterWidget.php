<?php

/**
 * Class PriceFilterWidget
 */
class PriceFilterWidget extends \yupe\widgets\YWidget
{
    /**
     * @var string
     */
    public $view = 'price-filter';
    public $category_id;

    public function init() {
        $mainAssets = Yii::app()->getTheme()->getAssetsUrl();

        Yii::app()->getClientScript()->registerCssFile($mainAssets . '/css/rangeSlider.css');
        Yii::app()->getClientScript()->registerScriptFile($mainAssets . '/ion.rangeSlider/js/ion.rangeSlider.min.js', CClientScript::POS_END);
    }
    /**
     * @throws CException
     */
    public function run()
    {
        $model = StoreCategory::model()->findByPk($this->category_id);
        if($model){
            $products = array_merge($model->getChildsArray(), [$model->id]);
            $cost =  Yii::app()->getDb()->createCommand()
                ->select('min(price_result) as minPrice, max(price_result) as maxPrice')
                ->from('{{store_product}}')
                ->where(['in', 'category_id',$products])
                ->queryRow();
        }else{
            $cost = Yii::app()->db->createCommand('SELECT min(price_result) as minPrice, max(price_result) as maxPrice FROM yupe_store_product where 1')->queryRow();
        }
        $this->render($this->view, ['cost' => $cost]);
    }
}