<?php
Yii::import('application.modules.mail.MailModule');
/**
 * Форма Остались вопросы? Задайте их нам
 */
class CallbackForm extends CFormModel
{
    public $name;
    public $email;
    public $phone;
    public $body;
    public $verify;
    public $verifyCode;

    public function rules()
    {
        return [
            ['name, phone, email', 'required'],
            ['email', 'email'],
            ['verify, body, email', 'safe'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'name'   => Yii::t('MailModule.mail', 'Ваше имя'),
            'email'  => Yii::t('MailModule.mail', 'Ваш e-mail'),
            'phone'  => Yii::t('MailModule.mail', 'Ваш телефон'),
            'body'   => Yii::t('MailModule.mail', 'Ваш вопрос'),
            'verify' => Yii::t('MailModule.mail', 'Verify'),
        ];
    }

    public function beforeValidate(){
        if ($_POST['g-recaptcha-response']=='') {
            $this->addError('verifyCode', Yii::t('MailModule.mail', 'Пройдите проверку reCAPTCHA..'));
        } else {
            $ip = CHttpRequest::getUserHostAddress();
            $post = [
                'secret' => Yii::app()->params['secretkey'],
                'response' => $_POST['g-recaptcha-response'],
                'remoteip' => $ip,
            ];

            $ch = curl_init('https://www.google.com/recaptcha/api/siteverify');
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
            $response = curl_exec($ch);
            curl_close($ch);

            $response = CJSON::decode($response);
            if (isset($response['success']) and isset($response['error-codes']) and $response['success']===false) {
                $this->addError('verifyCode', implode(', ', $response['error-codes']));
            }
        }
        return parent::beforeValidate();
    }
    
    public function afterValidate()
    {
        if (empty($this->getErrors())) {
            // Yii::app()->mailMessage->raiseMailEvent('vyzvat-mastera', $this->getAttributes());
        }
        return parent::afterValidate();
    }
}
?>