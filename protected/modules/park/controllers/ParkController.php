<?php
/**
* ParkController контроллер для park на публичной части сайта
*
* @author yupe team <team@yupe.ru>
* @link https://yupe.ru
* @copyright 2009-2021 amyLabs && Yupe! team
* @package yupe.modules.park.controllers
* @since 0.1
*
*/
Yii::import('application.modules.page.models.*');

class ParkController extends \yupe\components\controllers\FrontController
{
    /**
     * Действие "по умолчанию"
     *
     * @return void
     */
    /* public function actionIndex()
    {
        $module = Yii::app()->getModule('park');

        $page = Page::model()->findByPk($module->pageId);
        if(!$page){
            throw new CHttpException(404, Yii::t('ParkModule.park', 'Page was not found'));
        }

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

        $this->render('index', [
            'dataProvider' => $dataProvider,
            'model' => $page,
        ]);
    } */

    public function actionView($slug)
    {
        $model = Park::model()->published()->find(
            'slug = :slug',
            [
                ':slug' => $slug,
            ]
        );

        if (null === $model) {
            throw new CHttpException(404, Yii::t('CarbrandsModule.carbrands', 'Page was not found'));
        }

        $this->render('view', [
            'model' => $model
        ]);
    }
}