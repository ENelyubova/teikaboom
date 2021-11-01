<?php
/**
 * PagesNewWidget виджет для вывода страниц
 *
 * @author yupe team <team@yupe.ru>
 * @link http://yupe.ru
 * @copyright 2009-2013 amyLabs && Yupe! team
 * @package yupe.modules.page.widgets
 * @since 0.1
 *
 */
Yii::import('application.modules.page.models.*');

/**
 * Class PagesNewWidget
 */
class PagesNewWidget extends yupe\widgets\YWidget
{
    public $id;
    public $ids;
    public $parent_id;
    public $limit;
    public $listView;
    /**
     * @var string
     */
    public $view = 'pageswidget';

    protected $pages;
    protected $dataProvider;

    public function init()
    {

        if($this->parent_id){
            $criteria = new CDbCriteria(array(
                'condition'=>'parent_id=:parent_id',
                'params'=>array(':parent_id'=>$this->parent_id),
            ));
            // $criteria->addCondition("status = 1");
            $criteria->order = 't.order ASC';
            if($this->limit){
                $criteria->limit = $this->limit;
            }
            $this->pages = Page::model()->published()->findAll($criteria);
        } elseif($this->ids) {
            $this->ids = explode(',', $this->ids);
            if(is_array($this->ids) and !empty($this->ids)) {
                $this->pages = Page::model()->findAllByPk($this->ids, ['order' => 't.order ASC']);
            }
        } elseif($this->id) {
            $this->pages = Page::model()->published()->findByPk($this->id);

            if($this->listView){
                $criteria = new CDbCriteria(array(
                    'condition'=>'parent_id=:parent_id',
                    'params'=>array(':parent_id'=>$this->id),
                ));
                $criteria->addCondition("t.status = 1");
                $criteria->order = 't.order ASC';

                $this->dataProvider = new CActiveDataProvider('Page', [
                    'criteria' => $criteria,
                    'pagination' => [
                        'pageSize' => $this->limit,
                    ],
                ]);
            }
        }


        parent::init();
    }

    /**
     * @throws CException
     */
    public function run()
    {
        $this->render($this->view,[
            'pages' => $this->pages,
            'dataProvider' => $this->dataProvider,
        ]);
    }
}
