<?php
/**
 * ParkWidget виджет для вывода парков
 *
 */
Yii::import('application.modules.park.models.*');

/**
 * Class ParkWidget
 */
class ParkWidget extends yupe\widgets\YWidget
{
    public $limit;
    public $view = 'parkwidget';

    /**
     * @throws CException
     */
    public function run()
    {
        $module = Yii::app()->getModule('park');

        $dbCriteria = new CDbCriteria([
            'condition' => 't.status = :status',
            'params' => [
                ':status' => Park::STATUS_PUBLIC,
            ],
            'order' => 't.position ASC',
        ]);

        $dataProvider = new CActiveDataProvider('Park', [
            'criteria' => $dbCriteria,
            'pagination' => [
                'pageSize' => $module->itemsPerPage,
            ],
        ]);

        $this->render($this->view,[
            'dataProvider' => $dataProvider,
        ]);
    }
}
