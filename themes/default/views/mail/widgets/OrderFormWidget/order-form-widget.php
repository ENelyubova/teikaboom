<div id="<?= $this->id ?>" class="modal modal-my modal-my-xs fade" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header box-style">
                <div data-dismiss="modal" class="modal-close"><div></div></div>
                <div class="box-style__header">
                    <div class="box-style__heading js-modal-header"></div>
                    <div class="box-style__desc js-modal-header-desc"></div>
                </div>
            </div>

                <?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', [
                    'id' => $this->id.'-form',
                    'type' => 'vertical',
                    'htmlOptions' => [
                        'class'     => 'form-my form-modal',
                        'data-type' => 'ajax-form',
                    ],
                ]); ?>

                <?php if (Yii::app()->user->hasFlash("{$this->id}")) : ?>
                    <script>
                        //yaCounter<?//= Yii::app()->params['yandexMetrika']; ?>//.reachGoal('<?//= $model->metrik ?>//');
                        // ga('send','event','lead', 'send', '<?php //= $model->metrik ?>');
                        // fbq('track', 'Lead');
                        $('#<?= $this->id ?>').modal('hide');
                        $('#messageModal').modal('show');
                        setTimeout(function(){
                            $('#messageModal').modal('hide');
                        }, 4000);
                    </script>
                <?php endif ?>

                <div class="modal-body">
                    <?= $form->hiddenField($model, 'data', ['class' => 'js-modal-data']) ?>
                    <?= $form->hiddenField($model, 'theme', ['class' => 'js-modal-theme']) ?>
                    <?= $form->hiddenField($model, 'group', ['class' => 'js-modal-group']) ?>
                    <?= $form->hiddenField($model, 'verify', ['class' => 'js-modal-verify']) ?>
                    <?= $form->hiddenField($model, 'metrik', ['class' => 'js-modal-metrik']) ?>

                    <?= $form->textFieldGroup($model, 'name', [
                        'widgetOptions'=>[
                            'htmlOptions'=>[
                                'class' => '',
                                'autocomplete' => 'off'
                            ]
                        ]
                    ]); ?>

                    <?php if ($this->showAttributePhone) : ?>
                        <?= $form->telFieldGroup($model, 'phone', [
                            'widgetOptions' => [
                                'htmlOptions'=>[
                                    'class' => 'phone-mask',
                                    'data-phoneMask' => 'phone',
                                    'autocomplete' => 'off'
                                ]
                            ]
                        ]); ?>
                    <?php endif ?>

                    <?php if ($this->showAttributeEmail) : ?>
                        <?= $form->textFieldGroup($model, 'email', [
                            'widgetOptions'=>[
                                'htmlOptions'=>[
                                    'class' => '',
                                    'autocomplete' => 'off'
                                ]
                            ]
                        ]); ?>
                    <?php endif ?>
                    <?php if ($this->showAttributeComment) : ?>
                        <?= $form->textAreaGroup($model, 'comment', [
                            'widgetOptions'=>[
                                'htmlOptions'=>[
                                    'class' => '',
                                ]
                            ]
                        ]); ?>
                    <?php endif ?>

                    <div class="form-bot">
                        <?php if ($this->showCapcha) : ?>
                            <div class="form-button">
                                <div class="form-captcha">
                                    <div class="g-recaptcha" data-sitekey="<?= Yii::app()->params['key']; ?>"></div>
                                    <?= $form->error($model, 'verify');?>
                                </div>
                            </div>
                        <?php endif ?>
                        <div class="form-button">
                            <?= CHtml::submitButton(Yii::t('MailModule.mail', 'Отправить'), [
                                'class' => 'but js-modal-button',
                                'data-send'=>'ajax'
                            ]) ?>
                        </div>
                    </div>

                    <div class="terms_of_use">
                        * Оставляя заявку вы соглашаетесь с <a target="_blank" href="<?php $this->widget("application.modules.contentblock.widgets.ContentMyBlockWidget", ["id" => 4]); ?>">Условиями обработки персональных данных</a>
                     </div>
                </div>
            <?php $this->endWidget(); ?>
        </div>
    </div>
</div>