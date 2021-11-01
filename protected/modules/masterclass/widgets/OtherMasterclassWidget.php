<?php

/**
 * Виджет вывода Других мастер классов
 *
 * @category YupeWidget
 * @package  yupe.modules.news.widgets
 * @author   YupeTeam <team@yupe.ru>
 * @license  BSD http://ru.wikipedia.org/wiki/%D0%9B%D0%B8%D1%86%D0%B5%D0%BD%D0%B7%D0%B8%D1%8F_BSD
 * @version  0.5.3
 * @link     https://yupe.ru
 *
 **/
Yii::import('application.modules.masterclass.models.*');

/**
 * Class OtherMasterclassWidget
 */
class OtherMasterclassWidget extends yupe\widgets\YWidget
{
    public $limit;

    public $notId;
    public $parkId;

    /**
     * @var string
     */
    public $view = 'others-masterclass-widget';

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

        if ($this->notId) {
            $criteria->addCondition('t.id <> :id');
            $criteria->params[':id'] = $this->notId;
        }
        
        if ($this->parkId) {
            $criteria->addCondition('t.park_id = :park_id');
            $criteria->params[':park_id'] = $this->parkId;
        }

        $masterclass = Masterclass::model()->published()->findAll($criteria);


        $this->render($this->view, ['models' => $masterclass]);
    }
}
