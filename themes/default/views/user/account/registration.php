<?php
$this->title = Yii::t('UserModule.user', 'Sign up');
$this->breadcrumbs = [Yii::t('UserModule.user', 'Sign up')];

Yii::app()->getClientScript()->registerScriptFile('https://www.google.com/recaptcha/api.js', CClientScript::POS_END);

?>

<div class="lk-content lk-content-form">
    <div class="content">
        <div class="lk-form">
            <div class="lk-form__box">
                <div class="lk-form-header">
                    <h1><?= Yii::t('UserModule.user', 'Регистрация'); ?></h1>
                </div>

                <?php //$this->widget('yupe\widgets\YFlashMessages'); ?>

                <?php $form = $this->beginWidget(
                    'bootstrap.widgets.TbActiveForm',
                    [
                        'id' => 'registration-form',
                        'type' => 'vertical',
                        'htmlOptions' => [
                            'class' => 'registration-form form-my',
                        ]
                    ]
                ); ?>

                    <?php //= $form->errorSummary($model); ?>

                    <?php if (!$this->module->generateNickName) : ?>
                        <?php /*= $form->textFieldGroup($model, 'nick_name', [
                        'widgetOptions'=>[
                            'htmlOptions'=>[
                                'placeholder' => 'Логин',
                                'autocomplete' => 'off'
                            ]
                        ]
                    ]);*/ ?>
                    <?php endif; ?>

                    <?= $form->textFieldGroup($model, 'first_name'); ?>
                    <?= $form->textFieldGroup($model, 'email'); ?>
                    <?= $form->telFieldGroup($model, 'phone', [
                        'widgetOptions' => [
                            'htmlOptions'=>[
                                'class' => 'phone-mask',
                                'data-phoneMask' => 'phone',
                                'placeholder' => Yii::t('MailModule.mail', 'Телефон'),
                                'autocomplete' => 'off'
                            ]
                        ]
                    ]); ?>

                    <?= $form->passwordFieldGroup($model, 'password', [
                        'groupOptions'=>[
                            'class'=>'password-form-group',
                        ],
                        'appendOptions' => [
                            'class'=>'password-input-show',
                        ],
                        'append' => '<i class="fa fa-eye" aria-hidden="true"></i>'
                    ]); ?>

                    <div class="form-bot">
                        <div class="form-captcha">
                            <div class="g-recaptcha" data-sitekey="<?= Yii::app()->params['key']; ?>">
                            </div>
                            <?= $form->error($model, 'verifyCode');?>
                        </div>
                        <div class="form-button">
                            <button class="but but-blue-gradient but-animate-transform" id="registration-btn" data-send="ajax">
                                Зарегистрироваться
                            </button>
                        </div>
                    </div>

                    <div class="terms_of_use"> * Нажимая на кнопку "Зарегистрироваться", я даю согласие на обработку моих персональных данных в соответствии с Согласием об обработке персональных данных</div>

                    <?php if (Yii::app()->hasModule('social')) :
                        { ?>
                        <hr/>
                        <?php $this->widget(
                            'vendor.nodge.yii-eauth.EAuthWidget',
                            [
                                'action' => '/social/login',
                                'predefinedServices' => ['google', 'facebook', 'vkontakte', 'twitter', 'github'],
                            ]
                        ); ?>
                        <?php }
                    endif; ?>
                <?php $this->endWidget(); ?>
            </div>
            <div class="lk-form__bottom">
                Уже есть аккаунт?
                <a class="but-link" href="<?= Yii::app()->createUrl('user/account/login'); ?>"><?= Yii::t('UserModule.user', 'Войти'); ?></a>
            </div>
        </div>
    </div>
</div>