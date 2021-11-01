<?php 
    $mainAssets = Yii::app()->getTheme()->getAssetsUrl();
    $hasFlash = Yii::app()->user->hasFlash($this->successKey);
    Yii::app()->getClientScript()->registerScriptFile('https://www.google.com/recaptcha/api.js', CClientScript::POS_END);
?>

<?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', $this->formOptions) ?>
    <?php if ($hasFlash) : ?>
        <script>
            $("#messageModal").modal('show');
            setTimeout(function(){
                $("#messageModal").modal('hide');
            }, 4000);
        </script>
    <?php endif ?>

    <?= $form->hiddenField($model, 'key', ['value' => $this->id]) ?>

    <?php if ($this->showAttributeName) : ?>
        <div class="form-group form-group-filled <?= $model->hasErrors('name') ? 'has-error' : ''; ?>">
            <?= $form->textField($model, 'name', [
                'autocomplete' => 'off',
                'class' => 'form-control',
            ]); ?>
            <?= $form->labelEx($model, 'name') ?>
            <?= $form->error($model, 'name') ?>
        </div>
    <?php endif ?>

    <?php if ($this->showAttributePhone) : ?>
        <div class="form-group form-group-filled <?= $model->hasErrors('phone') ? 'has-error' : ''; ?>">
            <?= $form->telField($model, 'phone', [
                'autocomplete' => 'off',
                'class' => 'form-control phone-mask',
                'data-phoneMask' => 'phone',
            ]); ?>
            <?= $form->labelEx($model, 'phone') ?>
            <?= $form->error($model, 'phone') ?>
        </div>
    <?php endif ?>

    <?php if ($this->showAttributeEmail) : ?>
        <div class="form-group form-group-filled <?= $model->hasErrors('email') ? 'has-error' : ''; ?>">
            <?= $form->textField($model, 'email', [
                'autocomplete' => 'off',
                'class' => 'form-control',
            ]); ?>
            <?= $form->labelEx($model, 'email') ?>
            <?= $form->error($model, 'email') ?>
        </div>
    <?php endif ?>

    <?php if ($this->showAttributeComment) : ?>
        <div class="form-group form-group-filled <?= $model->hasErrors('comment') ? 'has-error' : ''; ?>">
            <?= $form->textArea($model, 'comment', [
                'autocomplete' => 'off',
                'class' => 'form-control',
            ]); ?>
            <?= $form->labelEx($model, 'comment') ?>
            <?= $form->error($model, 'comment') ?>
        </div>
    <?php endif ?>

    <?= $form->hiddenField($model, 'verifyCode') ?>
    <div class="form-captcha">
        <div class="g-recaptcha" data-sitekey="<?= Yii::app()->params['key']; ?>"></div>
        <?= $form->error($model, 'verify');?>
    </div>
                            
    <div class="form-bot fl fl-al-it-c">
        <div class="form-button">
            <button type="submit" class="but-3d but-brownlight-gradient" id="<?= $this->sendButtonId ?>">
                <span><?= $this->sendButtonText ?></span>
            </button>
        </div>
        <div class="terms_of_use">
            Нажимая кнопку Отправить заявку Вы соглашаетесь с <a target="_blank" href="<?php $this->widget('application.modules.contentblock.widgets.ContentMyBlockWidget', ['id' => 4]); ?>">Политикой обработки персональных данных</a>
        </div>
    </div>
<?php $this->endWidget() ?>

<?php Yii::app()->clientScript->registerScript($this->id.'-script', "
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
                
                findFilled();

                $.getScript('https://www.google.com/recaptcha/api.js', function () {});
            }
        })


        return false;
    })
") ?>