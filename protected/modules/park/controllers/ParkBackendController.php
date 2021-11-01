<?php
/**
* Класс ParkBackendController:
*
*   @category Yupe\yupe\components\controllers\BackController
*   @package  yupe
*   @author   Yupe Team <team@yupe.ru>
*   @license  https://github.com/yupe/yupe/blob/master/LICENSE BSD
*   @link     https://yupe.ru
**/
class ParkBackendController extends \yupe\components\controllers\BackController
{
    /**
     * @return array
     */
    public function accessRules()
    {
        return [
            ['allow', 'roles' => ['admin']],
            ['allow', 'actions' => ['index'], 'roles' => ['Park.ParkBackend.Index']],
            ['allow', 'actions' => ['view'], 'roles' => ['Park.ParkBackend.View']],
            ['allow', 'actions' => ['create'], 'roles' => ['Park.ParkBackend.Create']],
            [
                'allow',
                'actions' => ['update', 'inline', 'sortable', 'deleteImage', 'sortablephoto'],
                'roles' => ['Park.ParkBackend.Update'],
            ],
            ['allow', 'actions' => ['delete', 'multiaction'], 'roles' => ['Park.ParkBackend.Delete']],
            ['deny'],
        ];
    }
    
    public function actions()
    {
        return [
            'inline' => [
                'class'           => 'yupe\components\actions\YInLineEditAction',
                'model'           => 'Park',
                'validAttributes' => [
                    'status', 'name'
                ]
            ],
            'sortable' => [
                'class' => 'yupe\components\actions\SortAction',
                'model' => 'Park',
            ],
            'sortablephoto' => [
                'class' => 'yupe\components\actions\SortAction',
                'model' => 'ParkImage',
            ],
        ];
    }
    /**
    * Отображает Парк по указанному идентификатору
    *
    * @param integer $id Идинтификатор Парк для отображения
    *
    * @return void
    */
    public function actionView($id)
    {
        $this->render('view', ['model' => $this->loadModel($id)]);
    }
    
    /**
    * Создает новую модель Парка.
    * Если создание прошло успешно - перенаправляет на просмотр.
    *
    * @return void
    */
    public function actionCreate()
    {
        $model = new Park;

        if (Yii::app()->getRequest()->getPost('Park') !== null) {

            $this->updatePagePhotos($model);

            $model->setAttributes(Yii::app()->getRequest()->getPost('Park'));

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
    * Редактирование Парка.
    *
    * @param integer $id Идинтификатор Парк для редактирования
    *
    * @return void
    */
    public function actionUpdate($id)
    {
        $model = $this->loadModel($id);

        if (Yii::app()->getRequest()->getPost('Park') !== null) {

            $this->updatePagePhotos($model);

            $model->setAttributes(Yii::app()->getRequest()->getPost('Park'));

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
    * Удаляет модель Парка из базы.
    * Если удаление прошло успешно - возвращется в index
    *
    * @param integer $id идентификатор Парка, который нужно удалить
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
    * Управление Парками.
    *
    * @return void
    */
    public function actionIndex()
    {
        $model = new Park('search');
        $model->unsetAttributes(); // clear any default values
        if (Yii::app()->getRequest()->getParam('Park') !== null)
            $model->setAttributes(Yii::app()->getRequest()->getParam('Park'));
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
        $model = Park::model()->findByPk($id);
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

            $model = ParkImage::model()->findByPk($id);

            if (null !== $model) {
                $model->delete();
                Yii::app()->ajax->success();
            }
        }

        throw new CHttpException(404);
    }

    public function updatePagePhotos(Park $park)
    {
        if (Yii::app()->getRequest()->getPost('ParkImage')) {
            foreach (Yii::app()->getRequest()->getPost('ParkImage') as $key => $val) {
                $parkImage = ParkImage::model()->findByPk($key);
                if (null === $parkImage) {
                }
                $parkImage->setAttributes($_POST['ParkImage'][$key]);
                if (false === $parkImage->save()) {
                    Yii::app()->getUser()->setFlash(\yupe\widgets\YFlashMessages::ERROR_MESSAGE,
                        Yii::t('ParkModule.park', 'Error uploading some images...'));
                }
            }
        }
        foreach (CUploadedFile::getInstancesByName('ParkImage') as $key => $image) {
            $parkImage = new ParkImage();
            $parkImage->park_id = $park->id;
            $parkImage->attributes = $_POST['ParkImage'][$key];
            $parkImage->addFileInstanceName('ParkImage[' . $key . '][image]');
            $parkImage->save();
        }
    }
}
