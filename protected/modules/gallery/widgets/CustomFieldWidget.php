<?php
/**
 * CustomFieldWidget виджет для вывода страниц
 *
 * @author yupe team <team@yupe.ru>
 * @link http://yupe.ru
 * @copyright 2009-2013 amyLabs && Yupe! team
 * @package yupe.modules.page.widgets
 * @since 0.1
 *
 */

Yii::import('application.modules.gallery.models.*');
Yii::import('application.modules.news.models.*');
Yii::import('application.modules.services.models.*');

class CustomFieldWidget extends yupe\widgets\YWidget
{
    /**
     * Вьюха
     * @var string
     */
    public $module = 'Page';
    public $id = null;
    public $code = null;
    public $class;
    public $fancybox = false;
    public $view = 'gallery-customfield';
    public $htmlOptions = [];

    protected $model;

    public function init()
    {
        $this->model = $this->module::model()->published()->findByPk($this->id);
        
        parent::init();
    }

    public function run()
    {
        if ($this->model===null) {
            echo '';
        } else {
            $this->render($this->view, [
                'model' => $this->model,
                'code'   => $this->code,
                'class'   => $this->class,
                'htmlOptions'   => $this->htmlOptions,
                'fancybox'   => $this->fancybox,
            ]);
        }
    }
}