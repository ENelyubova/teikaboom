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
 *   @var $model Masterclass
 *   @var $form TbActiveForm
 *   @var $this MasterclassBackendController
 **/
?>
<ul class="nav nav-tabs">
    <li class="active"><a href="#common" data-toggle="tab">Общие</a></li>
    <li><a href="#gallery" data-toggle="tab">Галерея</a></li>
    <li><a href="#seo" data-toggle="tab">Данные для поисковой оптимизации</a></li>
</ul>

<?php
$form = $this->beginWidget(
    '\yupe\widgets\ActiveForm', [
        'id'                     => 'masterclass-form',
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
            <div class="col-sm-4">
                <?= $form->datePickerGroup(
                    $model,
                    'date',
                    [
                        'widgetOptions' => [
                            'options' => [
                                'format' => 'dd-mm-yyyy',
                                'weekStart' => 1,
                                'autoclose' => true,
                            ],
                        ],
                        'prepend' => '<i class="fa fa-calendar"></i>',
                    ]
                );
                ?>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-4">
                <?= $form->dropDownListGroup(
                    $model,
                    'theme_id',
                    [
                        'widgetOptions' => [
                            'data' => MasterclassTheme::model()->getThemeList(),
                            'htmlOptions' => [
                                'empty' => Yii::t('MasterclassModule.masterclass', '--Выберите--'),
                                'encode' => false,
                            ],
                        ],
                    ]
                ); ?>
            </div>
            <div class="col-sm-4">
                <?= $form->dropDownListGroup(
                    $model,
                    'park_id',
                    [
                        'widgetOptions' => [
                            'data' => Park::model()->getListPark(),
                            'htmlOptions' => [
                                'empty' => Yii::t('MasterclassModule.masterclass', '--Выберите--'),
                                'encode' => false,
                            ],
                        ],
                    ]
                ); ?>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-8">
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
            <div class="col-sm-8">
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
                    !$model->isNewRecord && $model->image ? $model->getImageNewUrl(350, 140, false, null, 'image') : '#',
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
                
                <code>Рекомендуемый размер изображения 1000x715px, вес файла не более 400кб.</code>
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
        <div class="row">
            <div class="col-sm-3">
                <?=  $form->textFieldGroup($model, 'price', [
                    'widgetOptions' => [
                        'htmlOptions' => [
                            'class' => 'popover-help',
                            'data-original-title' => $model->getAttributeLabel('price'),
                            'data-content' => $model->getAttributeDescription('price')
                        ]
                    ]
                ]); ?>
            </div>
            <div class="col-sm-3">
                <?=  $form->textFieldGroup($model, 'duration', [
                    'widgetOptions' => [
                        'htmlOptions' => [
                            'class' => 'popover-help',
                            'data-original-title' => $model->getAttributeLabel('duration'),
                            'data-content' => $model->getAttributeDescription('duration')
                        ]
                    ]
                ]); ?>
            </div>
            <div class="col-sm-2">
                <?=  $form->textFieldGroup($model, 'age', [
                    'widgetOptions' => [
                        'htmlOptions' => [
                            'class' => 'popover-help',
                            'data-original-title' => $model->getAttributeLabel('age'),
                            'data-content' => $model->getAttributeDescription('age')
                        ]
                    ]
                ]); ?>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12 popover-help" data-original-title='<?= $model->getAttributeLabel('description_short'); ?>'
                 data-content='<?= $model->getAttributeDescription('description_short'); ?>'>
                <?= $form->labelEx($model, 'description_short'); ?>
                <?php
                $this->widget(
                    $this->module->getVisualEditor(),
                    [
                        'model'     => $model,
                        'attribute' => 'description_short',
                    ]
                ); ?>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12 popover-help" data-original-title='<?= $model->getAttributeLabel('description'); ?>'
                 data-content='<?= $model->getAttributeDescription('description'); ?>'>
                <?= $form->labelEx($model, 'description'); ?>
                <?php
                $this->widget(
                    $this->module->getVisualEditor(),
                    [
                        'model'     => $model,
                        'attribute' => 'description',
                    ]
                ); ?>
            </div>
        </div>
    </div>
    <div class="tab-pane" id="gallery">
        <div id="photos">
            <style type="text/css">
                
            </style>
           <?php 
                Yii::app()->getClientScript()->registerCoreScript( 'jquery.ui' );
                $mainAssets = Yii::app()->assetManager->publish(Yii::getPathOfAlias('gallery.views.assets'));
                Yii::app()->getClientScript()->registerCssFile($mainAssets . '/css/gallery.css');
                Yii::app()->getClientScript()->registerScriptFile($mainAssets . '/js/gallery-sortable.js', CClientScript::POS_END);
                
                Yii::app()->getClientScript()->registerCssFile($mainAssets . '/css/fileinput.min.css');
                Yii::app()->getClientScript()->registerScriptFile($mainAssets . '/js/fileinput.min.js', CClientScript::POS_END);
                
                $this->widget('gallery.extensions.colorbox.ColorBox', [
                    'target' => '.gallery-image',
                    'config' => [ // тут конфиги плагина, подробнее http://www.jacklmoore.com/colorbox
                    ],
                ]);
                Yii::app()->clientScript->registerScript("input", "
                    $('.photo-add-input').find('input').fileinput({
                         showCaption: false,
                         browseLabel: 'Выберите файл',
                         browseClass: 'btns',
                         dropZoneTitle:'Перетащите сюда ваши файлы <br>или',
                         removeLabel: 'Удалить',
                         uploadLabel:'Загрузить',
                         msgZoomModalHeading:'Детальный просмотр',
                         zoomTitle:'Детальный просмотр'
                         });
                ");

                $assetsfm = Yii::app()->getAssetManager()->publish(
                    Yii::getPathOfAlias('application.modules.yupe.views.assets.css')
                );
                Yii::app()->getClientScript()->registerCssFile($assetsfm . '/photos.css');

                $keys = [];
            ?>
    
    
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <div class="photo-add-input">
                                <label>Добавить изображения</label>
                                <?php echo CHtml::fileField("MasterclassImage[][image]",'', ['multiple'=>true]); ?><br/>
                            </div>
                        </div>
                    </div>
                </div>
                <?php if (!$model->getIsNewRecord()): ?>
                    <div id="galleryField-wrapper">
                        <div class="row">
                            <div class="col-sm-12 gallery-thumbnails thumbnails">
                                <?php foreach ($model->photos(['order' => 'position DESC']) as $image): ?>
                                    <?php $keys[] = sprintf('<span data-order="%d">%d</span>', $image->position, $image->id); ?>
                                    <div class="col-md-3 col-sm-4 col-xs-6 imageField-wrapper image-wrapper">
                                        <div class="gallery-thumbnail">
                                            <div class="field-photo">
                                                <div class="field-photo__img">
                                                    <div class="move-sign">
                                                        <span class="fa fa-4x fa-arrows"></span>
                                                    </div>
                                                    <img src="<?= $image->getImageUrl(170, 170); ?>" alt=""/>
                                                </div>
                                                <div class="btn-group image-settings">
                                                    <button type="button" class="btn btn-default page-delete-photo" data-id="<?= $image->id; ?>"><span class="fa fa-fw fa-times"></span></button>
                                                    <button type="button" 
                                                        class="btn btn-default" 
                                                        data-toggle="modal"
                                                        data-backdrop="false"
                                                        data-target="#image-settings<?= $image->id; ?>">
                                                            <span class="fa fa-gear"></span>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="image-settings<?= $image->id; ?>" class="modal modal-my modal-my-xs fade" role="dialog">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="container-fluid">
                                                            <div class="row">
                                                                <div class="col-sm-4">
                                                                    <div class="modal-preview-image">
                                                                        <img src="<?= $image->getImageUrl(170, 170); ?>" alt=""/>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-8">
                                                                    <div class="row">
                                                                        <div class="col-xs-12">
                                                                            <div class="form-group">
                                                                                <?= CHtml::textField('MasterclassImage['.$image->id.'][title]', $image->title,['class' => 'form-control', 'placeholder' => 'Title']) ?>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-xs-12">
                                                                            <div class="form-group">
                                                                                <?= CHtml::textField('MasterclassImage['.$image->id.'][alt]', $image->alt,['class' => 'form-control', 'placeholder' => 'Alt']) ?>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-xs-12">
                                                                            <div class="form-group">
                                                                                <?= CHtml::textArea('MasterclassImage['.$image->id.'][description]', $image->description,['class' => 'form-control', 'placeholder' => 'Описание']) ?>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-danger" data-dismiss="modal" aria-hidden="true">Закрыть</button>
                                                        <button type="submit" class="btn btn-primary">Сохранить и обновить</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            <div class="sortOrder hidden"
                data-token-name="<?= Yii::app()->getRequest()->csrfTokenName; ?>"
                data-token="<?= Yii::app()->getRequest()->getCsrfToken(); ?>"
                data-action="<?= Yii::app()->createUrl('/masterclass/masterclassBackend/sortablephoto') ?>"
                >
                <?= implode('', $keys) ?>
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
            'label'      => Yii::t('MasterclassModule.masterclass', 'Сохранить Мастер класс и продолжить'),
        ]
    ); ?>
    <?php $this->widget(
        'bootstrap.widgets.TbButton', [
            'buttonType' => 'submit',
            'htmlOptions'=> ['name' => 'submit-type', 'value' => 'index'],
            'label'      => Yii::t('MasterclassModule.masterclass', 'Сохранить Мастер класс и закрыть'),
        ]
    ); ?>

<script type="text/javascript">
    $('.nav-tabs a').on('shown.bs.tab', function() {
        var codeMirrorContainer = $($(this).attr('href')).find(".CodeMirror")[0];
        if (codeMirrorContainer && codeMirrorContainer.CodeMirror) {
            codeMirrorContainer.CodeMirror.refresh();
        }
    });
    $(function () {
        $('.page-delete-photo').on('click', function (event) {
            event.preventDefault();
            var blockForDelete = $(this).closest('.imageField-wrapper');
            $.ajax({
                type: "POST",
                data: {
                    'id': $(this).data('id'),
                    '<?= Yii::app()->getRequest()->csrfTokenName;?>': '<?= Yii::app()->getRequest()->csrfToken;?>'
                },
                url: '<?= Yii::app()->createUrl('/masterclass/masterclassBackend/deleteImage');?>',
                success: function () {
                    blockForDelete.remove();
                }
            });
        });
    });
</script>


<?php $this->endWidget(); ?>