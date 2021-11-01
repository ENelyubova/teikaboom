<?php

/**
 * GeneralFeedbackWidget
 */
class GeneralFeedbackWidget extends \yupe\widgets\YWidget
{
    public $id = null;
    public $modalHtmlOptions = [];
    public $formOptions = [];
    public $formClassName = null;
    public $successKey = 'success';
    public $successMessage = 'Ваша заявка успешно отправлена.';
    public $isRefresh = false;
    public $buttonModal = null;
    public $titleModal = 'Заказать звонок';
    public $subTitleModal = 'Оставьте заявку и мы Вам перезвоним!';
    public $showCloseButton = true;
    public $sendButtonText = 'Отправить';
    public $sendButtonId = null;
    public $view = 'general-feedback-widget';
    public $modelAttributes = [];
    public $eventCode = 'zayavki-iz-modalnyh-okon';

    // Для формула трафика
    public $showAttributeName = true;
    public $showAttributePhone = true;
    public $showAttributeEmail = false;
    public $showAttributeComment = false;
    public $showAttributeJson = false;

    public function init()
    {
        if ($this->formClassName===null) {
            throw new CException("Необходимо установить свойство 'formClassName' классе ".get_class($this));
        }

        if ($this->id===null) {
            throw new CException("Необходимо установить свойство 'id' классе ".get_class($this));
        }

        // установка параметров для модального окна
        $this->modalHtmlOptions['id'] = $this->id;
        if (isset($this->modalHtmlOptions['class'])) {
            $this->modalHtmlOptions['class'] = $this->modalHtmlOptions['class'].' modal fade';
        }
        $this->modalHtmlOptions['tabindex'] = "-1";

        if (!isset($this->formOptions['id'])) {
            $this->formOptions['id'] = $this->id.'-form';
        }

        if ($this->sendButtonId===null) {
            $this->sendButtonId = $this->id.'-send-button';
        }

        return parent::init();
    }

    public function run()
    {
        $model = new $this->formClassName;

        if (isset($_POST[$this->formClassName])) {
            $key = isset($_POST[$this->formClassName]['key']) ? $_POST[$this->formClassName]['key'] : '';
            if ($key===$this->id) {
                $model->setAttributes($_POST[$this->formClassName]);
                if ($model->verifyCode == '') {
                    if ($model->validate()) {
                        $this->sendData($model->attributes);
                        Yii::app()->user->setFlash($this->successKey, $this->successMessage);
                        if ($this->isRefresh) {
                            Yii::app()->controller->refresh();
                        }
                    }
                }
            }
        }

        $this->render($this->view, [
            'model' => $model,
        ]);
    }

    public function sendData($data)
    {
        $dataSerialize = [];
        $data = array_merge($data, $this->modelAttributes);
        if($this->showAttributeJson){
            parse_str($data['json'], $json);
            $data = array_merge($data, $json['CalcForm']);
        }
        if(isset($data['is_avans'])){
            $data['is_avans'] = $data['is_avans'] == 0 ? 'Нет' : 'Да';
        }

        // Отправка данных на почту
        if ($this->eventCode) {
            Yii::app()->mailMessage->raiseMailEvent($this->eventCode, $data);
        }
    }
}
