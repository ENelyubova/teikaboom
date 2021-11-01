<?php

/**
 * Виджет вывода последних новостей
 *
 * @category YupeWidget
 * @package  yupe.modules.news.widgets
 * @author   YupeTeam <team@yupe.ru>
 * @license  BSD http://ru.wikipedia.org/wiki/%D0%9B%D0%B8%D1%86%D0%B5%D0%BD%D0%B7%D0%B8%D1%8F_BSD
 * @version  0.5.3
 * @link     https://yupe.ru
 *
 **/
Yii::import('application.modules.news.models.*');
Yii::import('application.components.NewsCPagination');

/**
 * Class NewsHomeWidget
 */
class NewsHomeWidget extends yupe\widgets\YWidget
{
    /** @var $categories mixed Список категорий, из которых выбирать новости. NULL - все */
    public $categories = null;
    public $limit = 16;
    public $order = 't.date DESC';

    /**
     * @var string
     */
    public $itemView = '_item';
    public $view = 'news-widget';

    protected $dataProvider;
    protected $pageSize;

    public function init()
    {
        $this->pageSize = $this->limit;

        if(isset($_GET['page']) && $_GET['page'] > 1){
            $this->pageSize = $this->pageSize - 1;
            $this->itemView = '_item';
        }
        parent::init();
    }

    /**
     * @throws CException
     */
    public function run()
    {
        $criteria = new CDbCriteria;
        $criteria->addCondition("t.status = 1");
        $criteria->order = $this->order;

        if ($this->categories) {
            if (is_array($this->categories)) {
                $criteria->addInCondition('category_id', $this->categories);
            } else {
                $criteria->compare('category_id', $this->categories);
            }
        }

        $this->dataProvider = new CActiveDataProvider('News', [
            'criteria' => $criteria,
            'pagination' => [
                'class' => 'NewsCPagination',
                'pageSize' => $this->pageSize,
                'pageVar' => 'page'
            ],
        ]);

        $this->render($this->view, [
            'dataProvider' => $this->dataProvider,
            'itemView' => $this->itemView
        ]);
    }
}
