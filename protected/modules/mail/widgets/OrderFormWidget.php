<?php

/**
 * OrderFormWidget
 */

Yii::import('application.modules.mail.models.form.FormBase');
Yii::import('application.modules.mail.models.MailOrder');

class OrderFormWidget extends yupe\widgets\YWidget
{
    public $id;
    public $view = 'order-form-widget';

    public $showAttributePhone = true;
    public $showAttributeEmail = false;
    public $showAttributeComment = false;
    public $showCapcha = false;

    public $group = false; // Группа (указывать, если необходимо группировать заявки)
    public $theme = false; // Тема заявки
    public $ongoal = false; // Идентификатор цели
    public $success = '';

    public $modelAttributes = [];
    public $eventCode = 'osnovnoe-sobytie';

    public function run()
    {
        $this->registerJs();
        $model = new FormBase($this->id);
        $model->showCapcha = $this->showCapcha;

        if (isset($_POST['FormBase']) and $_POST['FormBase']['htmlId']===$this->id && Yii::app()->request->isAjaxRequest) {
            $model->attributes = $_POST['FormBase'];
            if ($model->validate()) {
                $this->sendData($model->attributes);
                Yii::app()->user->setFlash($this->id, 'Заявка успешно отправлена');
                // Yii::app()->controller->refresh();
            }
        }

        $this->render($this->view, [
            'model' => $model,
        ]);
    }

    public function sendData($data)
    {
        $order = new MailOrder;
        $order->setAttributes($this->getAttributes());
        $order->save();

        $dataSerialize = [];
        $data = array_merge($data, $this->modelAttributes);

        // Отправка данных на почту
        if ($this->eventCode) {
            Yii::app()->mailMessage->raiseMailEvent($this->eventCode, $data);
        }
    }

    public function registerJs()
    {
        $siteName = Yii::app()->getModule('yupe')->siteName;
        $loadCapcha = $this->showCapcha ? '$.getScript("https://www.google.com/recaptcha/api.js", function () {});' : '';

        $varName = preg_replace('/[^\w]+/', '', $this->id);
        $varMetrik = preg_replace('/[^\w]+/', '', $this->id).'_metrik';

        Yii::app()->clientScript->registerScript(__FILE__.$this->id, "
            var $varName = '#{$this->id}-form';
            var $varMetrik = '{$this->ongoal}';

            $('#{$this->id}').on('hide.bs.modal', function(e) {
                $($varName).get(0).reset();
                $($varName).attr('ongoal', '');
            });

            $('#{$this->id}').on('show.bs.modal', function(e) {
                // console.log(e.relatedTarget);
                var title, desc, button, theme, group,
                    button      = $(e.relatedTarget),
                    modalGroup  = button.data('group'),
                    modalTheme  = button.data('theme')
                    modalTitle  = button.data('modal-title'),
                    modalDesc   = button.data('modal-desc'),
                    modalButton = button.data('modal-button'),
                    metrika     = button.data('ongoal');

                title  = 'Остались вопросы?';
                desc   = 'Оставьте заявку и мы Вам перезвоним!';
                button = 'Отправить';
                group = '';

                if (modalTitle) title = modalTitle;
                if (modalDesc) desc = modalDesc;
                if (modalButton) button = modalButton;

                theme = 'Заявка «' + title + '» с сайта {$siteName}';
                if (modalTheme) theme = modalTheme;

                if (modalGroup) group = modalGroup;

                $(this).find('.js-modal-header').html(title);
                $(this).find('.js-modal-header-desc').html(desc);
                $(this).find('.js-modal-button').val(button);
                $(this).find('.js-modal-metrik').val(metrika);

                $(this).find('.js-modal-theme').val(theme);
                $(this).find('.js-modal-group').val(group);

                if ($(this).find('input[data-mask=\"phone\"]').is('.data-mask')) {
                    $(this)
                        .find('input[data-mask=\"phone\"]')
                        .mask(\"+7(999)999-99-99\", {
                            'placeholder':'_',
                        });
                }

                if($(this).find('input[data-phoneMask=phone]').is('.phone-mask')){
                    $('.phone-mask').inputmask(phoneMaskTemplate, {inputmode: 'numeric'});
                }
            });

            var send = true;
            $(document).on('submit', $varName, function() {
                if (send===false) {
                    return false;
                }

                setTimeout(function() {
                    send = true;
                }, 1000);

                send = false;
                var form = $(this),
                action = form.attr('action'),
                data = form.serialize();
                $.ajax({
                    url: action,
                    type: 'post',
                    data: data,
                    success: function(html) {
                        var html = $(html);
                        var form = html.find($varName);

                        $($varName).html(form.html());

                        if ($($varName).find('input[data-mask=\"phone\"]').is('.data-mask')) {
                            $($varName)
                                .find('input[data-mask=\"phone\"]')
                                .mask(\"+7(999)999-99-99\", {
                                    'placeholder':'_',
                                });
                        }

                        if($($varName).find('input[data-phoneMask=phone]').is('.phone-mask')){
                            $('.phone-mask').inputmask(phoneMaskTemplate, {inputmode: 'numeric'});
                        }

                        {$loadCapcha}

                        send = true;
                    }
                });
                return false;
            });
        ");
    }
}
