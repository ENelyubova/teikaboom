<?php
/**
* MasterclassController контроллер для masterclass на публичной части сайта
*
* @author yupe team <team@yupe.ru>
* @link https://yupe.ru
* @copyright 2009-2021 amyLabs && Yupe! team
* @package yupe.modules.masterclass.controllers
* @since 0.1
*
*/

class MasterclassController extends \yupe\components\controllers\FrontController
{
        
    /**
     * @var PosterRepository
     */
    protected $posterRepository;
    
    public function init(){
        
        $this->posterRepository = Yii::app()->getComponent('posterRepository');

        parent::init();
    }
    
    /**
     * Действие "по умолчанию"
     *
     * @return void
     */
    public function actionIndex()
    {
        $module = Yii::app()->getModule('masterclass');

        $page = Page::model()->findByPk($module->pageId);
        if(!$page){
            throw new CHttpException(404, Yii::t('MasterclassModule.masterclass', 'Page was not found'));
        }

        $dbCriteria = new CDbCriteria([
            'condition' => 't.status = :status',
            'params' => [
                ':status' => Masterclass::STATUS_PUBLIC,
            ],
            'order' => 't.position ASC',
        ]);

        if(isset($_GET['theme_id']) && $_GET['theme_id']){
            $dbCriteria->addCondition('t.theme_id = :theme_id');
            $dbCriteria->params['theme_id'] = (int)$_GET['theme_id'];
        }

        $dataProvider = new CActiveDataProvider('Masterclass', [
            'criteria' => $dbCriteria,
            'pagination' => [
                'pageSize' => $module->itemsPerPage,
            ],
        ]);

        $this->render('index', [
            'dataProvider' => $dataProvider,
            'model' => $page,
        ]);
    }

    public function actionView($slug)
    {
        $module = Yii::app()->getModule('masterclass');

        $page = Page::model()->findByPk($module->pageId);
        
        if (Yii::app()->getRequest()->getParam('date') && Yii::app()->getRequest()->getIsAjaxRequest()){
            $events =  $this->posterRepository->getPosterByDate(Yii::app()->getRequest()->getParam('date'));
            
            $this->renderPartial('_eventsModal', [
                'date' => Yii::app()->getRequest()->getParam('date'),
                'events' => $events,
            ]);
            Yii::app()->end();
        }
        
        if(!$page){
            throw new CHttpException(404, Yii::t('MasterclassModule.masterclass', 'Page was not found'));
        }

        $model = Masterclass::model()->published()->find(
            'slug = :slug',
            [
                ':slug' => $slug,
            ]
        );

        if (null === $model) {
            throw new CHttpException(404, Yii::t('CarbrandsModule.carbrands', 'Page was not found'));
        }

        $this->render('view', [
            'model' => $model,
            'modelPage' => $page,
        ]);
    }
    
    public function actionAfisha()
    {
        $module = Yii::app()->getModule('masterclass');

        $page = Page::model()->findByPk($module->pageAfishaId);
        if(!$page){
            throw new CHttpException(404, Yii::t('MasterclassModule.masterclass', 'Page was not found'));
        }
        $poster = $this->posterRepository->getPoster();

        $this->render('view-afisha', [
            'poster' => $poster,
            'modelPage' => $page,
        ]);
    }
}