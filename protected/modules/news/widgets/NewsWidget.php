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

/**
 * Class NewsWidget
 */
class NewsWidget extends yupe\widgets\YWidget
{
    /** @var $categories mixed Список категорий, из которых выбирать новости. NULL - все */
    public $categories = null;
    public $limit;
    public $notId;
    public $parkId;

    /**
     * @var string
     */
    public $view = 'lastnewswidget';

    /**
     * @throws CException
     */
    public function run()
    {
        $criteria = new CDbCriteria();
        if($this->limit){
            $criteria->limit = (int)$this->limit;
        }
        
        $criteria->order = 'date DESC';

        if ($this->categories) {
            if (is_array($this->categories)) {
                $criteria->addInCondition('category_id', $this->categories);
            } else {
                $cat = NewsCategory::model()->published()->findByPk($this->categories);
                if($cat){
                    $criteria->compare('category_id', $cat->id);
                }
            }
        }

        if ($this->notId) {
            $criteria->addCondition('t.id <> :id');
            $criteria->params[':id'] = $this->notId;
        }
        
        if ($this->parkId) {
            $criteria->addCondition('t.park_id = :park_id');
            $criteria->params[':park_id'] = $this->parkId;
        }

        $news = ($this->controller->isMultilang())
            ? News::model()->published()->language(Yii::app()->getLanguage())->findAll($criteria)
            : News::model()->published()->findAll($criteria);


        $this->render($this->view, ['models' => $news, 'category' => $cat]);
    }
}
