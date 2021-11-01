<?php
/**
* Класс MasterclassThemeBackendController:
*
*   @category Yupe\yupe\components\controllers\BackController
*   @package  yupe
*   @author   Yupe Team <team@yupe.ru>
*   @license  https://github.com/yupe/yupe/blob/master/LICENSE BSD
*   @link     https://yupe.ru
**/
class MasterclassThemeBackendController extends \yupe\components\controllers\BackController
{
    /**
     * @return array
     */
    public function accessRules()
    {
        return [
            ['allow', 'roles' => ['admin']],
            ['allow', 'actions' => ['index'], 'roles' => ['MasterclassTheme.MasterclassThemeBackend.Index']],
            ['allow', 'actions' => ['view'], 'roles' => ['MasterclassTheme.MasterclassThemeBackend.View']],
            ['allow', 'actions' => ['create'], 'roles' => ['MasterclassTheme.MasterclassThemeBackend.Create']],
            [
                'allow',
                'actions' => ['update', 'inline', 'sortable', 'deleteImage', 'sortablephoto'],
                'roles' => ['MasterclassTheme.MasterclassThemeBackend.Update'],
            ],
            ['allow', 'actions' => ['delete', 'multiaction'], 'roles' => ['MasterclassTheme.MasterclassThemeBackend.Delete']],
            ['deny'],
        ];
    }
    
    public function actions()
    {
        return [
            'inline' => [
                'class'           => 'yupe\components\actions\YInLineEditAction',
                'model'           => 'MasterclassTheme',
                'validAttributes' => [
                    'status', 'name'
                ]
            ],
            'sortable' => [
                'class' => 'yupe\components\actions\SortAction',
                'model' => 'MasterclassTheme',
            ],
        ];
    }
    /**
    * Отображает Тему по указанному идентификатору
    *
    * @param integer $id Идинтификатор Тему для отображения
    *
    * @return void
    */
    public function actionView($id)
    {
        $this->render('view', ['model' => $this->loadModel($id)]);
    }
    
    /**
    * Создает новую модель Темы.
    * Если создание прошло успешно - перенаправляет на просмотр.
    *
    * @return void
    */
    public function actionCreate()
    {
        $model = new MasterclassTheme;

        if (Yii::app()->getRequest()->getPost('MasterclassTheme') !== null) {
            $model->setAttributes(Yii::app()->getRequest()->getPost('MasterclassTheme'));
        
            if ($model->save()) {
                Yii::app()->user->setFlash(
                    yupe\widgets\YFlashMessages::SUCCESS_MESSAGE,
                    Yii::t('MasterclassModule.masterclass', 'Запись добавлена!')
                );

                $this->redirect(
                    (array)Yii::app()->getRequest()->getPost(
                        'submit-type',
                        [
                            'update',
                            'id' => $model->id
                        ]
                    )
                );
            }
        }
        $this->render('create', ['model' => $model]);
    }
    
    /**
    * Редактирование Темы.
    *
    * @param integer $id Идинтификатор Тему для редактирования
    *
    * @return void
    */
    public function actionUpdate($id)
    {
        $model = $this->loadModel($id);

        if (Yii::app()->getRequest()->getPost('MasterclassTheme') !== null) {
            $model->setAttributes(Yii::app()->getRequest()->getPost('MasterclassTheme'));

            if ($model->save()) {
                Yii::app()->user->setFlash(
                    yupe\widgets\YFlashMessages::SUCCESS_MESSAGE,
                    Yii::t('MasterclassModule.masterclass', 'Запись обновлена!')
                );

                $this->redirect(
                    (array)Yii::app()->getRequest()->getPost(
                        'submit-type',
                        [
                            'update',
                            'id' => $model->id
                        ]
                    )
                );
            }
        }
        $this->render('update', ['model' => $model]);
    }
    
    /**
    * Удаляет модель Темы из базы.
    * Если удаление прошло успешно - возвращется в index
    *
    * @param integer $id идентификатор Темы, который нужно удалить
    *
    * @return void
    */
    public function actionDelete($id)
    {
        if (Yii::app()->getRequest()->getIsPostRequest()) {
            // поддерживаем удаление только из POST-запроса
            $this->loadModel($id)->delete();

            Yii::app()->user->setFlash(
                yupe\widgets\YFlashMessages::SUCCESS_MESSAGE,
                Yii::t('MasterclassModule.masterclass', 'Запись удалена!')
            );

            // если это AJAX запрос ( кликнули удаление в админском grid view), мы не должны никуда редиректить
            if (!Yii::app()->getRequest()->getIsAjaxRequest()) {
                $this->redirect(Yii::app()->getRequest()->getPost('returnUrl', ['index']));
            }
        } else
            throw new CHttpException(400, Yii::t('MasterclassModule.masterclass', 'Неверный запрос. Пожалуйста, больше не повторяйте такие запросы'));
    }
    
    /**
    * Управление Темами.
    *
    * @return void
    */
    public function actionIndex()
    {
        $model = new MasterclassTheme('search');
        $model->unsetAttributes(); // clear any default values
        if (Yii::app()->getRequest()->getParam('MasterclassTheme') !== null)
            $model->setAttributes(Yii::app()->getRequest()->getParam('MasterclassTheme'));
        $this->render('index', ['model' => $model]);
    }
    
    /**
    * Возвращает модель по указанному идентификатору
    * Если модель не будет найдена - возникнет HTTP-исключение.
    *
    * @param integer идентификатор нужной модели
    *
    * @return void
    */
    public function loadModel($id)
    {
        $model = MasterclassTheme::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, Yii::t('MasterclassModule.masterclass', 'Запрошенная страница не найдена.'));

        return $model;
    }
}
