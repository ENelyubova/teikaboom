<?php $hasFlash = Yii::app()->user->hasFlash($this->successKey) ?>

<?php if ($this->buttonModal) : ?>
    <?= CHtml::link($this->buttonModal, "#{$this->id}", [
        'data-toggle' => 'modal',
        'data-target' => "#{$this->id}",
    ])  ?>
<?php endif; ?>
<?= CHtml::openTag('div', $this->modalHtmlOptions) ?>
    <div class="modal-dialog">
        <div class="modal-content">

            <?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', $this->formOptions) ?>
                <div class="modal-header box-style">
                    <div class="box-style__header">
                        <div data-dismiss="modal" class="modal-close"><div></div></div>
                        <div class="modal-header__heading box-style__heading color-pink" id="myModalLabel"><?= $this->titleModal; ?></div>
                        <div class="box-style__desc"><?= $this->subTitleModal ?></div>
                    </div>
                </div>
                <div class="modal-body">
                    <?php if ($hasFlash) : ?>
                        <!-- <div class="modal-success-message"><?= Yii::app()->user->getFlash($this->successKey) ?></div> -->
                        <script>
                            $("#<?= $this->id; ?>").modal('hide');
                            $("#messageModal").modal('show');
                            setTimeout(function(){
                                $("#messageModal").modal('hide');
                            }, 4000);
                        </script>
                    <?php endif ?>

                    <?= $form->hiddenField($model, 'key', ['value' => $this->id]) ?>
                    <?php if ($this->showAttributeName) : ?>
                        <?= $form->textFieldGroup($model, 'name', [
                            'widgetOptions'=>[
                                'htmlOptions'=>[
                                    'class' => '',
                                    'autocomplete' => 'off'
                                ]
                            ]
                        ]); ?>
                    <?php endif ?>

                    <?php if ($this->showAttributePhone) : ?>
                        <?= $form->telFieldGroup($model, 'phone', [
                            'widgetOptions' => [
                                'htmlOptions'=>[
                                    'class' => 'phone-mask',
                                    'data-phoneMask' => 'phone',
                                    'placeholder' => Yii::t('MailModule.mail', 'Ваш телефон'),
                                    'autocomplete' => 'off'
                                ]
                            ]
                        ]); ?>
                    <?php endif ?>

                    <?php if ($this->showAttributeEmail) : ?>
                        <?= $form->textFieldGroup($model, 'email') ?>
                    <?php endif ?>

                    <?php if ($this->showAttributeComment) : ?>
                        <?= $form->textAreaGroup($model, 'comment') ?>
                    <?php endif ?>

                    <?php if ($this->showAttributeJson) : ?>
                        <?= $form->hiddenField($model, 'json') ?>
                    <?php endif ?>
                    
                    <?= $form->hiddenField($model, 'verifyCode') ?>

                    <div class="form-bot">
                        <div class="form-button">
                            <div class="form-captcha">
                                <div class="g-recaptcha" data-sitekey="<?= Yii::app()->params['key']; ?>"></div>
                                <?= $form->error($model, 'verify');?>
                            </div>
                        </div>
                        <div class="form-button">
                            <?php if ($this->showCloseButton) : ?>
                                <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
                            <?php endif ?>
                            <button type="submit" class="but but-pink but-animation" id="<?= $this->sendButtonId ?>">
                                <span><?= $this->sendButtonText ?></span>
                                <?php //= file_get_contents('.'. Yii::app()->getTheme()->getAssetsUrl() . '/images/svg/but-arrow-right.svg'); ?>
                            </button>
                        </div>
                    </div>
                    <div class="terms_of_use">
                        * Оставляя заявку Вы соглашаетесь с
                        <a target="_blank" href="<?php $this->widget('application.modules.contentblock.widgets.ContentMyBlockWidget', ['id' => 4]); ?>">Условиями обработки персональных данных</a>
                    </div>
                </div>
            <?php $this->endWidget() ?>
        </div>
    </div>
<?= CHtml::closeTag('div') ?>

<?php Yii::app()->clientScript->registerScript($this->id.'-script', "
$('#{$this->modalHtmlOptions['id']}').on('show.bs.modal', function (e) {
    var head = document.getElementsByTagName('head')[0];
    var script = document.createElement('script');
    $.getScript('https://www.google.com/recaptcha/api.js', function () {});
    head.appendChild(script);
});

$(document).delegate('#{$this->formOptions['id']}', 'submit', function() {
    var form = $(this);
    var data = form.serialize();
    var url = form.attr('action');
    var type = form.attr('method');
    var selectorForm = '#{$this->formOptions['id']}';
    $.ajax({
        url: url,
        type: type,
        data: data,
        dataType: 'html',
        success: function(data) {
            $(selectorForm).html($(data).find(selectorForm).html());
            
            if($(selectorForm).find('input[data-mask=phone]').is('.data-mask')){
                $('[data-mask=phone]').mask(phoneMaskTemplate, {
                    'placeholder':'_',
                    'completed':function() {
                    }
                });
            }

            if($(selectorForm).find('input[data-phoneMask=phone]').is('.phone-mask')){
                $('.phone-mask').inputmask(phoneMaskTemplate, {inputmode: 'numeric'});
            }

            $.getScript('https://www.google.com/recaptcha/api.js', function () {});
        }
    })


    return false;
})
") ?>