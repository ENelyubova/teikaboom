<?php
/**
* Класс ParkPageBackendController:
*
*   @category Yupe\yupe\components\controllers\BackController
*   @package  yupe
*   @author   Yupe Team <team@yupe.ru>
*   @license  https://github.com/yupe/yupe/blob/master/LICENSE BSD
*   @link     https://yupe.ru
**/
class ParkPageBackendController extends \yupe\components\controllers\BackController
{
    /**
     * @return array
     */
    public function accessRules()
    {
        return [
            ['allow', 'roles' => ['admin']],
            ['allow', 'actions' => ['index'], 'roles' => ['Park.ParkPageBackend.Index']],
            ['allow', 'actions' => ['view'], 'roles' => ['Park.ParkPageBackend.View']],
            ['allow', 'actions' => ['create'], 'roles' => ['Park.ParkPageBackend.Create']],
            [
                'allow',
                'actions' => ['update', 'inline', 'sortable', 'deleteImage', 'sortablephoto'],
                'roles' => ['Park.ParkPageBackend.Update'],
            ],
            ['allow', 'actions' => ['delete', 'multiaction'], 'roles' => ['Park.ParkPageBackend.Delete']],
            ['deny'],
        ];
    }
    
    public function actions()
    {
        return [
            'inline' => [
                'class'           => 'yupe\components\actions\YInLineEditAction',
                'model'           => 'ParkPage',
                'validAttributes' => [
                    'status', 'name'
                ]
            ],
            'sortable' => [
                'class' => 'yupe\components\actions\SortAction',
                'model' => 'ParkPage',
            ],
            'sortablephoto' => [
                'class' => 'yupe\components\actions\SortAction',
                'model' => 'ParkPageImage',
            ],
        ];
    }
    /**
    * Отображает Аттракцион по указанному идентификатору
    *
    * @param integer $id Идинтификатор Аттракцион для отображения
    *
    * @return void
    */
    public function actionView($id)
    {
        $this->render('view', ['model' => $this->loadModel($id)]);
    }
    
    /**
    * Создает новую модель Аттракциона.
    * Если создание прошло успешно - перенаправляет на просмотр.
    *
    * @return void
    */
    public function actionCreate()
    {
        $model = new ParkPage;

        if (Yii::app()->getRequest()->getPost('ParkPage') !== null) {

            $this->updatePagePhotos($model);

            $model->setAttributes(Yii::app()->getRequest()->getPost('ParkPage'));
        
            if ($model->save()) {
                Yii::app()->user->setFlash(
                    yupe\widgets\YFlashMessages::SUCCESS_MESSAGE,
                    Yii::t('ParkModule.park', 'Запись добавлена!')
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
    * Редактирование Аттракциона.
    *
    * @param integer $id Идинтификатор Аттракцион для редактирования
    *
    * @return void
    */
    public function actionUpdate($id)
    {
        $model = $this->loadModel($id);

        if (Yii::app()->getRequest()->getPost('ParkPage') !== null) {

            $this->updatePagePhotos($model);

            $model->setAttributes(Yii::app()->getRequest()->getPost('ParkPage'));

            if ($model->save()) {
                Yii::app()->user->setFlash(
                    yupe\widgets\YFlashMessages::SUCCESS_MESSAGE,
                    Yii::t('ParkModule.park', 'Запись обновлена!')
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
    * Удаляет модель Аттракциона из базы.
    * Если удаление прошло успешно - возвращется в index
    *
    * @param integer $id идентификатор Аттракциона, который нужно удалить
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
                Yii::t('ParkModule.park', 'Запись удалена!')
            );

            // если это AJAX запрос ( кликнули удаление в админском grid view), мы не должны никуда редиректить
            if (!Yii::app()->getRequest()->getIsAjaxRequest()) {
                $this->redirect(Yii::app()->getRequest()->getPost('returnUrl', ['index']));
            }
        } else
            throw new CHttpException(400, Yii::t('ParkModule.park', 'Неверный запрос. Пожалуйста, больше не повторяйте такие запросы'));
    }
    
    /**
    * Управление Аттракционами.
    *
    * @return void
    */
    public function actionIndex()
    {
        $model = new ParkPage('search');
        $model->unsetAttributes(); // clear any default values
        if (Yii::app()->getRequest()->getParam('ParkPage') !== null)
            $model->setAttributes(Yii::app()->getRequest()->getParam('ParkPage'));
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
        $model = ParkPage::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, Yii::t('ParkModule.park', 'Запрошенная страница не найдена.'));

        return $model;
    }

    /**
     * @throws CHttpException
     */
    public function actionDeleteImage()
    {
        if (Yii::app()->getRequest()->getIsPostRequest() && Yii::app()->getRequest()->getIsAjaxRequest()) {

            $id = (int)Yii::app()->getRequest()->getPost('id');

            $model = ParkPageImage::model()->findByPk($id);

            if (null !== $model) {
                $model->delete();
                Yii::app()->ajax->success();
            }
        }

        throw new CHttpException(404);
    }

    public function updatePagePhotos(ParkPage $parkPage)
    {
        if (Yii::app()->getRequest()->getPost('ParkPageImage')) {
            foreach (Yii::app()->getRequest()->getPost('ParkPageImage') as $key => $val) {
                $parkPageImage = ParkPageImage::model()->findByPk($key);
                if (null === $parkPageImage) {
                }
                $parkPageImage->setAttributes($_POST['ParkPageImage'][$key]);
                if (false === $parkPageImage->save()) {
                    Yii::app()->getUser()->setFlash(\yupe\widgets\YFlashMessages::ERROR_MESSAGE,
                        Yii::t('ParkModule.park', 'Error uploading some images...'));
                }
            }
        }
        foreach (CUploadedFile::getInstancesByName('ParkPageImage') as $key => $image) {
            $parkPageImage = new ParkPageImage();
            $parkPageImage->park_page_id = $parkPage->id;
            $parkPageImage->attributes = $_POST['ParkPageImage'][$key];
            $parkPageImage->addFileInstanceName('ParkPageImage[' . $key . '][image]');
            $parkPageImage->save();
        }
    }
}
