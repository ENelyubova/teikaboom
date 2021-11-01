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
 *   @var $model MasterclassTheme
 *   @var $form TbActiveForm
 *   @var $this MasterclassThemeBackendController
 **/
?>
<ul class="nav nav-tabs">
    <li class="active"><a href="#common" data-toggle="tab">Общие</a></li>
    <li><a href="#seo" data-toggle="tab">Данные для поисковой оптимизации</a></li>
</ul>

<?php
$form = $this->beginWidget(
    '\yupe\widgets\ActiveForm', [
        'id'                     => 'masterclass-theme-form',
        'enableAjaxValidation'   => false,
        'enableClientValidation' => true,
        'htmlOptions' => ['class' => 'well', 'enctype' => 'multipart/form-data'],
    ]
);
?>

<div class="alert alert-info">
    <?=  Yii::t('MasterclassModule.masterclass', 'Поля, отмеченные'); ?>
    <span class="required">*</span>
    <?=  Yii::t('MasterclassModule.masterclass', 'обязательны.'); ?>
</div>

<?=  $form->errorSummary($model); ?>

<div class="tab-content">
    <div class="tab-pane active" id="common">
        <div class="row">
            <div class="col-sm-4">
                <?= $form->dropDownListGroup(
                    $model,
                    'status',
                    [
                        'widgetOptions' => [
                            'data' => $model->getStatusList(),
                            'htmlOptions' => [
                                'class' => 'popover-help',
                                'data-original-title' => $model->getAttributeLabel('status'),
                                'data-content' => $model->getAttributeDescription('status'),
                            ],
                        ],
                    ]
                ); ?>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-7">
                <?=  $form->textFieldGroup($model, 'name_short', [
                    'widgetOptions' => [
                        'htmlOptions' => [
                            'class' => 'popover-help',
                            'data-original-title' => $model->getAttributeLabel('name_short'),
                            'data-content' => $model->getAttributeDescription('name_short')
                        ]
                    ]
                ]); ?>
            </div>
        </div>
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
            <div class="col-sm-8">
                <?= $form->slugFieldGroup($model, 'slug', ['sourceAttribute' => 'name']); ?>
            </div>
        </div>
        <div class='row'>
            <div class="col-sm-8">
                <?php
                echo CHtml::image(
                    !$model->isNewRecord && $model->image ? $model->getImageNewUrl(100, 100, false, null, 'image') : '#',
                    $model->name,
                    [
                        'class' => 'preview-image',
                        'style' => !$model->isNewRecord && $model->image ? 'max-width: 400px' : 'display:none',
                    ]
                ); ?>

                <?php if (!$model->isNewRecord && $model->image) : ?>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="delete-file"> <?= Yii::t('YupeModule.yupe', 'Delete the file') ?>
                            </label>
                        </div>
                <?php endif; ?>
                
                <code>Рекомендуемый размер изображения 110x80px, вес файла не более 500кб.</code>
                <?= $form->fileFieldGroup(
                    $model,
                    'image',
                    [
                        'widgetOptions' => [
                            'htmlOptions' => [
                            ],
                        ],
                    ]
                ); ?>
            </div>
        </div>
    </div>
    <div class="tab-pane" id="seo">
        <div class="row">
            <div class="col-sm-8">
                <?=  $form->textFieldGroup($model, 'title', [
                    'widgetOptions' => [
                        'htmlOptions' => [
                            'class' => 'popover-help',
                            'data-original-title' => $model->getAttributeLabel('title'),
                            'data-content' => $model->getAttributeDescription('title')
                        ]
                    ]
                ]); ?>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-8">
                <?=  $form->textFieldGroup($model, 'meta_title', [
                    'widgetOptions' => [
                        'htmlOptions' => [
                            'class' => 'popover-help',
                            'data-original-title' => $model->getAttributeLabel('meta_title'),
                            'data-content' => $model->getAttributeDescription('meta_title')
                        ]
                    ]
                ]); ?>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-8">
                <?=  $form->textAreaGroup($model, 'meta_keywords', [
                'widgetOptions' => [
                    'htmlOptions' => [
                        'class' => 'popover-help',
                        'rows' => 6,
                        'cols' => 50,
                        'data-original-title' => $model->getAttributeLabel('meta_keywords'),
                        'data-content' => $model->getAttributeDescription('meta_keywords')
                    ]
                ]]); ?>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-8">
                <?=  $form->textAreaGroup($model, 'meta_description', [
                'widgetOptions' => [
                    'htmlOptions' => [
                        'class' => 'popover-help',
                        'rows' => 6,
                        'cols' => 50,
                        'data-original-title' => $model->getAttributeLabel('meta_description'),
                        'data-content' => $model->getAttributeDescription('meta_description')
                    ]
                ]]); ?>
            </div>
        </div>
    </div>
</div>
    <?php $this->widget(
        'bootstrap.widgets.TbButton', [
            'buttonType' => 'submit',
            'context'    => 'primary',
            'label'      => Yii::t('MasterclassModule.masterclass', 'Сохранить Тему и продолжить'),
        ]
    ); ?>
    <?php $this->widget(
        'bootstrap.widgets.TbButton', [
            'buttonType' => 'submit',
            'htmlOptions'=> ['name' => 'submit-type', 'value' => 'index'],
            'label'      => Yii::t('MasterclassModule.masterclass', 'Сохранить Тему и закрыть'),
        ]
    ); ?>

<?php $this->endWidget(); ?>