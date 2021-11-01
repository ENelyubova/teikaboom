<?php
/**
 *
 **/
Yii::import('application.modules.contentblock.models.ContentBlock');
Yii::import('application.modules.contentblock.ContentBlockModule');

/**
 * Class ContentBlockWidget
 */
class ContentMyBlockWidget extends yupe\widgets\YWidget
{
    /**
     * @var
     */
    public $id;
    public $class;
    /**
     * @var string
     */
    public $view = 'contentblock';

    /**
     * @throws CException
     */
    public function run()
    {
        $cacheName = "ContentMyBlock{$this->id}";
        
        $block = Yii::app()->getCache()->get($cacheName);
        
        if (false === $block) {
            $block = ContentBlock::model()->findByPk($this->id);

            Yii::app()->getCache()->set($cacheName, $block);
        }

        $this->render($this->view, [
            'block' => $block,
            'class' => $this->class,
        ]);
    }
}
