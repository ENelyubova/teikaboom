<?php
$this->title = Yii::t('UserModule.user', 'Sign in');
$this->breadcrumbs = [Yii::t('UserModule.user', 'Sign in')];

?>

<div class="lk-content">
    <div class="content">
        <?php $this->widget('application.components.MyTbBreadcrumbs', [
            'links' => $this->breadcrumbs,
        ]); ?>
        <div class="lk-authorization lk-authorization-sm-12">
            <div class="lk-authorization__left">
                    <h1><?= Yii::t('UserModule.user', 'Войти в личный кабинет'); ?></h1>

                    <?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', [
                        'id' => 'login-form',
                        'type' => 'vertical',
                        'htmlOptions' => [
                            'class' => 'login-form',
                        ]
                    ]); ?>

                        <?php //= $form->errorSummary($model); ?>
                        
                        
                        <?= $form->textFieldGroup($model, 'email', [
                            'widgetOptions'=>[
                                'htmlOptions'=>[
                                    'class' => '',
                                    'placeholder' => 'Ваш E-mail',
                                    'autocomplete' => 'off'
                                ]
                            ]
                        ]); ?>
                        
                        <div class="login-form__item">
                            <?= $form->passwordFieldGroup($model, 'password', [
                                'groupOptions'=>[
                                    'class'=>'password-form-group',
                                ],
                                'appendOptions' => [
                                    'class'=>'password-input-show',
                                ],
                                'append' => '<i class="fa fa-eye" aria-hidden="true"></i>'
                            ]); ?>
                            <?= CHtml::link(Yii::t('UserModule.user', 'Forgot your password?'), ['/user/account/recovery'], [
                                'class' => 'login-form__link'
                            ]) ?>
                        </div>

                        <?php if ($this->getModule()->sessionLifeTime > 0): ?>
                            <!-- <div class="checkbox checkbox-one">
                                <input checked="checked" name="LoginForm[remember_me]" id="LoginForm_remember_me" value="1" type="checkbox">
                                <label for="LoginForm_remember_me">Запомнить меня</label>
                            </div> -->
                        <?php endif; ?>

                        <div class="form-bot">
                            <div class="form-button fl">
                                <button class="but but-blue-gradient but-animate-transform" id="login-btn" data-send="ajax">
                                    Войти
                                </button> 
                            </div>
                        </div>

                        <?php if (Yii::app()->hasModule('social')): ?>
                            <?php $this->widget(
                                'vendor.nodge.yii-eauth.EAuthWidget',
                                [
                                    'action' => '/social/login',
                                    'predefinedServices' => ['google', 'facebook', 'vkontakte', 'twitter', 'github'],
                                ]
                            ); ?>
                        <?php endif; ?>
                    <?php $this->endWidget(); ?>
            </div>
            <div class="lk-authorization__right">
                <div class="lk-authorization-reg">
                    <div class="lk-authorization-reg__text">
                        <h2>Еще нет аккаунта?</h2>
                        <p><?= Yii::t('UserModule.user', 'Зарегистрируйтесь на'); ?></p> <?= file_get_contents('.'. $this->mainAssets . '/images/logo.svg'); ?>
                    </div>
                    <div class="lk-authorization-reg__but fl">
                         <a class="but but-green-gradient but-animate-transform" href="<?= Yii::app()->createUrl('user/account/registration'); ?>"><?= Yii::t('UserModule.user', 'Зарегистрироваться'); ?></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php if (Yii::app()->user->hasFlash("success")) : ?>
    <div id="registrationSuccessModal" class="modal modal-my fade" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header box-style">
                    <div data-dismiss="modal" class="modal-close"><div></div></div>
                    <div class="box-style__header">
                        <div class="box-style__heading">
                            Уведомление
                        </div>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="message-success">
                        <?= Yii::app()->user->getFlash('success') ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php Yii::app()->clientScript->registerScript('registration-script', "
        $('#registrationSuccessModal').modal('show');
        setTimeout(function(){
            $('#registrationSuccessModal').modal('hide');
        }, 10000);
    ") ?>
<?php endif; ?>