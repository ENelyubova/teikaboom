<?php
use yupe\widgets\YPurifier;

/**
 * Форма обратный звонок
 */
Yii::import('application.modules.mail.MailModule');
Yii::import('application.modules.mail.models.MailOrder');

class FormBase extends CFormModel
{
    public $theme;
    public $group;
    public $name;
    public $phone;
    public $email;
    public $comment;
    public $verify;
    public $data;
    public $htmlId;
    public $check;
    public $metrik;

    public $showCapcha = false;

    public function rules()
    {
        return [
            ['name, phone, htmlId', 'required'],
            // ['phone', 'match', 'pattern' => '/\+7 \(\d{3}\) \d{3} \d{4}/'],
            ['check', 'required', 'on' => 'quest-calback'],
            ['name, phone, verify, comment', 'filter', 'filter' => 'trim'],
            ['name, phone, verify, comment', 'filter', 'filter' => [new YPurifier(), 'purify']],
            ['email', 'email'],
            ['theme, comment, group, data, metrik', 'safe'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'name'   => 'Форма',
            'name'   => 'Ваше имя',
            'phone'  => 'Ваш телефон',
            'email'  => 'Ваш E-mail',
            'comment'   => 'Сообщение',
            'verify' => 'Код проверки',
            'check' => 'С Политикой конфиденциальности ознакомлен',
        ];
    }

    public function beforeValidate()
    {
        if ($this->showCapcha) {
            if ($_POST['g-recaptcha-response']=='') {
                $this->addError('verify', 'Пройдите проверку reCAPTCHA..');
            } else {
                $post = [
                    'secret' => Yii::app()->params['secretkey'],
                    'response' => $_POST['g-recaptcha-response'],
                ];

                $ch = curl_init('https://www.google.com/recaptcha/api/siteverify');
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
                $response = curl_exec($ch);
                curl_close($ch);

                $response = CJSON::decode($response);
                if (isset($response['success']) and isset($response['error-codes']) and $response['success']===false) {
                    $this->addError('verify', implode(', ', $response['error-codes']));
                }
            }
        }

        return parent::beforeValidate();
    }
}
