<?php

Yii::import('application.modules.slider.models.Slider');

class SliderWidget extends yupe\widgets\YWidget
{
    public $limit = 6;
    public $category_id;
    /**
     * @var string
     */
    public $view = 'slider-widget';
    protected $models;

    public function init()
    {
        $criteria = new CDbCriteria();
        $criteria->limit = $this->limit;
        $criteria->order = 't.position ASC';
        $criteria->compare('category_id', $this->category_id);
        
        $this->models = Slider::model()->published()->findAll($criteria);

        parent::init();
    }

    public function run()
    {
        $this->render($this->view, [
            'models' => $this->models
        ]);
    }
}
