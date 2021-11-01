<div id="loginModal" class="modal modal-my modal-authorization fade" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header box-style">
                <div data-dismiss="modal" class="modal-close"><div></div></div>
            </div>
            <?php $form = $this->beginWidget(
                'bootstrap.widgets.TbActiveForm',
                [
                    'id' => 'login-modal-form',
                    'type' => 'vertical',
                    'htmlOptions' => [
                        'class' => 'login-form form-my',
                    ]
                ]
            ); ?>
                <?php //= $form->errorSummary($model); ?>

                <div class="modal-body">
                    <div class="modal-authorization__header">
                        <?= Yii::t('UserModule.user', 'Вход'); ?>
                    </div>
                    <?php if (Yii::app()->user->hasFlash("login-success")) : ?>
                        <div class="message-success">
                            <p><?= Yii::app()->user->getFlash('login-success') ?></p>
                        </div>
                        <script>
                            $('.success-hid').hide();
                            window.location.reload();
                        </script>
                    <?php endif; ?>
                    <div class="success-hid">
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
                        <?php if (Yii::app()->getUser()->getState('badLoginCount', 0) >= 3 && CCaptcha::checkRequirements('gd')): { ?>
                            <?php Yii::app()->getClientScript()->registerScriptFile('https://www.google.com/recaptcha/api.js', CClientScript::POS_END); ?>
                            <div class="form-captcha">
                                <div class="g-recaptcha" data-sitekey="<?= Yii::app()->params['key']; ?>">
                                </div>
                                <?= $form->error($model, 'verifyCode');?>
                            </div>
                        <?php } endif; ?>
                        <div class="form-my__but">
                            <button class="but but-orange-gradient but-animation " id="login-btn" data-send="ajax">
                                Войти
                            </button>
                        </div>

                        <?php if (Yii::app()->hasModule('social')) : ?>
                            <?php $this->widget(
                                'vendor.nodge.yii-eauth.EAuthWidget',
                                [
                                    'action' => '/social/login',
                                    'predefinedServices' => ['google', 'facebook', 'vkontakte', 'twitter', 'github'],
                                ]
                            ); ?>
                        <?php endif; ?>
                        <div class="modal-authorization__bottom fl fl-di-c fl-al-it-c">
                            <span>Еще нет аккаунта?</span>
                            <a class="but-link js-modal-reg" href="<?= Yii::app()->createUrl('user/account/registration'); ?>"><?= Yii::t('UserModule.user', 'Зарегистрироваться'); ?></a>
                        </div>
                    </div>
                <?php $this->endWidget(); ?>
            </div>
        </div>
    </div>
</div>

<?php Yii::app()->clientScript->registerScript('login-form-script', "
$(document).delegate('#login-modal-form', 'submit', function() {
    var form = $(this);
    var data = form.serialize();
    var url = form.attr('action');
    var type = form.attr('method');
    var selectorForm = '#login-modal-form';
    $.ajax({
        url: url,
        type: type,
        data: data,
        dataType: 'html',
        success: function(data) {
            $(selectorForm).html($(data).find(selectorForm).html());

            $.getScript('https://www.google.com/recaptcha/api.js', function () {});
        }
    })
    return false;
});
// $(document).delegate('.js-modal-reg', 'click', function() {
//     var modal = $(this).data('reg');
//     $('#loginModal').modal('hide');
//     $(modal).modal('show');
//     return false;
// });
") ?>

