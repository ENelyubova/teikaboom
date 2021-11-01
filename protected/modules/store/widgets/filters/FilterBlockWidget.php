<?php

/**
 * Class FilterBlockWidget
 */
class FilterBlockWidget extends \yupe\widgets\YWidget
{
    /**
     * @var string
     */
    public $view = 'filter-block';

    /**
     * @var
     */
    public $attributes;

    /**
     * @var
     */
    public $category;
    
    /**
     * @throws CException
     */
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
        $this->render($this->view, ['attributes' => $this->attributes, 'category' => $this->category]);
    }
} 
