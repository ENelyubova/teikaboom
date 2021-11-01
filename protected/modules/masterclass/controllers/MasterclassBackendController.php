<?php
/**
* Класс MasterclassBackendController:
*
*   @category Yupe\yupe\components\controllers\BackController
*   @package  yupe
*   @author   Yupe Team <team@yupe.ru>
*   @license  https://github.com/yupe/yupe/blob/master/LICENSE BSD
*   @link     https://yupe.ru
**/
class MasterclassBackendController extends \yupe\components\controllers\BackController
{
    /**
     * @return array
     */
    public function accessRules()
    {
        return [
            ['allow', 'roles' => ['admin']],
            ['allow', 'actions' => ['index'], 'roles' => ['Masterclass.MasterclassBackend.Index']],
            ['allow', 'actions' => ['view'], 'roles' => ['Masterclass.MasterclassBackend.View']],
            ['allow', 'actions' => ['create'], 'roles' => ['Masterclass.MasterclassBackend.Create']],
            ['allow', 'actions' => ['update', 'inline'], 'roles' => ['Masterclass.MasterclassBackend.Update']],
            ['allow', 'actions' => ['delete', 'multiaction'], 'roles' => ['Masterclass.MasterclassBackend.Delete']],
            ['deny'],
        ];
    }

    /**
     * @return array
     */
    public function actions()
    {
        return [
            'inline' => [
                'class' => 'yupe\components\actions\YInLineEditAction',
                'model' => 'Masterclass',
                'validAttributes' => ['title', 'slug', 'date', 'status', 'price'],
            ],
            'sortablephoto' => [
                'class' => 'yupe\components\actions\SortAction',
                'model' => 'MasterclassImage',
            ],
            'sortableMasterclass' => [
                'class' => 'yupe\components\actions\SortAction',
                'model' => 'Masterclass',
            ],
        ];
    }

    /**
    * Отображает Мастер класс по указанному идентификатору
    *
    * @param integer $id Идинтификатор Мастер класс для отображения
    *
    * @return void
    */
    public function actionView($id)
    {
        $this->render('view', ['model' => $this->loadModel($id)]);
    }
    
    /**
    * Создает новую модель Мастер класса.
    * Если создание прошло успешно - перенаправляет на просмотр.
    *
    * @return void
    */
    public function actionCreate()
    {
        $model = new Masterclass;

        if (Yii::app()->getRequest()->getPost('Masterclass') !== null) {
            
            $this->updatePagePhotos($model);

            $model->setAttributes(Yii::app()->getRequest()->getPost('Masterclass'));
        
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
    * Редактирование Мастер класса.
    *
    * @param integer $id Идинтификатор Мастер класс для редактирования
    *
    * @return void
    */
    public function actionUpdate($id)
    {
        $model = $this->loadModel($id);

        if (Yii::app()->getRequest()->getPost('Masterclass') !== null) {

            $this->updatePagePhotos($model);

            $model->setAttributes(Yii::app()->getRequest()->getPost('Masterclass'));

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
    * Удаляет модель Мастер класса из базы.
    * Если удаление прошло успешно - возвращется в index
    *
    * @param integer $id идентификатор Мастер класса, который нужно удалить
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
    * Управление Мастер классами.
    *
    * @return void
    */
    public function actionIndex()
    {
        $model = new Masterclass('search');
        $model->unsetAttributes(); // clear any default values
        if (Yii::app()->getRequest()->getParam('Masterclass') !== null)
            $model->setAttributes(Yii::app()->getRequest()->getParam('Masterclass'));
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
        $model = Masterclass::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, Yii::t('MasterclassModule.masterclass', 'Запрошенная страница не найдена.'));

        return $model;
    }

    /**
     * @throws CHttpException
     */
    public function actionDeleteImage()
    {
        if (Yii::app()->getRequest()->getIsPostRequest() && Yii::app()->getRequest()->getIsAjaxRequest()) {

            $id = (int)Yii::app()->getRequest()->getPost('id');

            $model = MasterclassImage::model()->findByPk($id);

            if (null !== $model) {
                $model->delete();
                Yii::app()->ajax->success();
            }
        }

        throw new CHttpException(404);
    }

    public function updatePagePhotos(Masterclass $Masterclass)
    {
        if (Yii::app()->getRequest()->getPost('MasterclassImage')) {
            foreach (Yii::app()->getRequest()->getPost('MasterclassImage') as $key => $val) {
                $MasterclassImage = MasterclassImage::model()->findByPk($key);
                if (null === $MasterclassImage) {
                }
                $MasterclassImage->setAttributes($_POST['MasterclassImage'][$key]);
                if (false === $MasterclassImage->save()) {
                    Yii::app()->getUser()->setFlash(\yupe\widgets\YFlashMessages::ERROR_MESSAGE,
                        Yii::t('ParkModule.park', 'Error uploading some images...'));
                }
            }
        }
        foreach (CUploadedFile::getInstancesByName('MasterclassImage') as $key => $image) {
            $MasterclassImage = new MasterclassImage();
            $MasterclassImage->masterclass_id = $Masterclass->id;
            $MasterclassImage->attributes = $_POST['MasterclassImage'][$key];
            $MasterclassImage->addFileInstanceName('MasterclassImage[' . $key . '][image]');
            $MasterclassImage->save();
        }
    }
}
