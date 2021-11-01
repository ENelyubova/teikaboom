<?php
/**
 * Отображение для _form:
 *
 *   @category YupeView
 *   @package  yupe
 *   @author   Yupe Team <team@yupe.ru>
 *   @license  https://github.com/yupe/yupe/blob/master/LICENSE BSD
 *   @link     https://yupe.ru
 *
 *   @var $model Badge
 *   @var $form TbActiveForm
 *   @var $this BadgeBackendController
 **/
$form = $this->beginWidget(
    'bootstrap.widgets.TbActiveForm', [
        'id'                     => 'badge-form',
        'enableAjaxValidation'   => false,
        'enableClientValidation' => true,
        'htmlOptions'            => ['class' => 'well'],
    ]
);
?>

<div class="alert alert-info">
    <?=  Yii::t('StoreModule.store', 'Поля, отмеченные'); ?>
    <span class="required">*</span>
    <?=  Yii::t('StoreModule.store', 'обязательны.'); ?>
</div>

<?=  $form->errorSummary($model); ?>

    <div class="row">
        <div class="col-sm-7">
            <?=  $form->textFieldGroup($model, 'name', [
                'widgetOptions' => [
                    'htmlOptions' => [
                        'class' => 'popover-help',
                        'data-original-title' => $model->getAttributeLabel('name'),
                        'data-content' => $model->getAttributeDescription('name')
                    ]
                ]
            ]); ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-7">
            <?=  $form->textFieldGroup($model, 'color', [
                'widgetOptions' => [
                    'htmlOptions' => [
                        'class' => 'popover-help',
                        'data-original-title' => $model->getAttributeLabel('color'),
                        'data-content' => $model->getAttributeDescription('color')
                    ]
                ]
            ]); ?>
        </div>
        <div class="col-sm-1 col-xs-1">
            <?php if (!$model->getIsNewRecord() && $model->color): ?>
                <label for=""></label>
                <div style='width: 50px; height: 34px; background: <?= $model->color; ?>;'></div>
            <?php endif; ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-7">
            <?=  $form->textFieldGroup($model, 'background', [
            'widgetOptions' => [
                'htmlOptions' => [
                    'class' => 'popover-help',
                    'data-original-title' => $model->getAttributeLabel('background'),
                    'data-content' => $model->getAttributeDescription('background')
                ]
            ]]); ?>
        </div>
        <div class="col-sm-1 col-xs-1">
            <?php if (!$model->getIsNewRecord() && $model->background): ?>
                <label for=""></label>
                <div style='width: 50px; height: 34px; background: <?= $model->background; ?>;'></div>
            <?php endif; ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-8">
            <?=  $form->dropDownListGroup($model, 'status', [
                'widgetOptions' => [
                    'data' => $model->getStatusList(),
                    'htmlOptions' => [
                        'class' => 'popover-help',
                        'data-original-title' => $model->getAttributeLabel('status'),
                        'data-content' => $model->getAttributeDescription('status')
                    ]
                ]
            ]); ?>
        </div>
    </div>

    <?php $this->widget(
        'bootstrap.widgets.TbButton', [
            'buttonType' => 'submit',
            'context'    => 'primary',
            'label'      => Yii::t('StoreModule.store', 'Сохранить Badge и продолжить'),
        ]
    ); ?>
    <?php $this->widget(
        'bootstrap.widgets.TbButton', [
            'buttonType' => 'submit',
            'htmlOptions'=> ['name' => 'submit-type', 'value' => 'index'],
            'label'      => Yii::t('StoreModule.store', 'Сохранить Badge и закрыть'),
        ]
    ); ?>

<?php $this->endWidget(); ?>