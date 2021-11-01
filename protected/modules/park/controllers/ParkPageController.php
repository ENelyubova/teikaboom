<?php
/**
* ParkPageController контроллер для park на публичной части сайта
*
* @author yupe team <team@yupe.ru>
* @link https://yupe.ru
* @copyright 2009-2021 amyLabs && Yupe! team
* @package yupe.modules.park.controllers
* @since 0.1
*
*/

class ParkPageController extends \yupe\components\controllers\FrontController
{
    /**
     * Действие "по умолчанию"
     *
     * @return void
     */
    public function actionIndex()
    {
        $this->render('index');
    }

    public function actionView($slug, $slugPark)
    {
        $modelPark = Park::model()->published()->find(
            'slug = :slug',
            [
                ':slug' => $slugPark,
            ]
        );

        if (null === $modelPark) {
            throw new CHttpException(404, Yii::t('CarbrandsModule.carbrands', 'Page was not found'));
        }

        $modelPage = ParkPage::model()->find(
            'slug = :slug AND park_id=:park_id',
            [
                ':park_id' => $modelPark->id,
                ':slug' => $slug,
            ]
        );

        if (null === $modelPage) {
            throw new CHttpException(404, Yii::t('CarbrandsModule.carbrands', 'Page was not found'));
        }

        $this->render($modelPage->view ?: 'view', [
            'modelPark' => $modelPark,
            'modelPage' => $modelPage
        ]);
    }
}