<?php
/**
*CRest api Bitrix24
*
**/
//require_once(Yii::getPathOfAlias('mail').'/components/crest-master/src/crest.php');
Yii::import('application.modules.mail.components.crest-master.src.*');

/**
 * StandertForm
 */
Yii::import('application.modules.mail.MailModule');

class StandartForm extends CFormModel
{
    public $name;
    public $email;
    public $phone;
    public $comment;
    public $json;
    public $key;
    public $verify;
    public $verifyCode;

    public function rules()
    {
        return [
            ['name, phone', 'required'],
            ['email', 'email'],
            ['phone', 'match', 'pattern' => Yii::app()->getModule('user')->phonePattern, 'message' => 'Не правильный формат телефона' ],
            ['name, key, verify, comment, json, verifyCode', 'safe'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'name'  => 'Ваше имя',
            'email' => 'Ваш E-mail',
            'phone' => 'Ваш телефон',
            'comment'  => 'Сообщение',
            'json'  => '',
        ];
    }

    public function beforeValidate()
    {
        if (isset($_POST['g-recaptcha-response']) and $_POST['g-recaptcha-response']=='') {
            $this->addError('verify', 'Пройдите проверку reCAPTCHA.');
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
        return parent::beforeValidate();
    }
    
    public function afterValidate()
    {
        if (empty($this->getErrors())) {
            $this->bitrix24Send($this);
        }
        return parent::afterValidate();
    }
    
    public function bitrix24Send($data)
    {
        $phone = (!empty($data->phone)) ? [['VALUE' => $data->phone, 'VALUE_TYPE' => 'WORK']] : [];
        $email = (!empty($data->email)) ? [['VALUE' => $data->email, 'VALUE_TYPE' => 'HOME']] : [];
        
        $title = 'Заявка с сайта TeikaBoom';
        
        $result = CRest::call(
            'crm.lead.add',
            [
                'fields' => [
                    'TITLE'              => $title,
                    'NAME'               => $data->name,
                    'PHONE'              => $phone,
                    'EMAIL'              => $email,
                    'COMMENTS'           => $data->comment,
                    'DATE_CREATE'        => date('Y-m-d H:i:s'),
                ]
            ]
        );
        
        return true;
    }
}
