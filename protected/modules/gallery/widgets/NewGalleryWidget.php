<?php
/**
 * PagesWidget виджет для вывода страниц
 *
 * @author yupe team <team@yupe.ru>
 * @link http://yupe.ru
 * @copyright 2009-2013 amyLabs && Yupe! team
 * @package yupe.modules.page.widgets
 * @since 0.1
 *
 */

Yii::import('application.modules.gallery.models.*');

class NewGalleryWidget extends yupe\widgets\YWidget
{
    /**
     * Вьюха
     * @var string
     */
    public $view = 'gallery-widget';
    public $id = null;
    public $galleryName = null;

    protected $models;

    public function init()
    {
        if ($this->id) {
            $this->models = Gallery::model()->findByPk($this->id);
        } else {
            $this->models = Gallery::model()->findByAttributes(['name' => $this->galleryName]);
        }
        
        parent::init();
    }

    public function run()
    {
        if ($this->models===null) {
            echo '';
        } else {
            $this->render($this->view, [
                'models' => $this->models
            ]);
        }
    }
}