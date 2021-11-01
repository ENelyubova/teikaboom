<?php
/**
 * @var $this NewsBackendController
 * @var $model News
 * @var $form \yupe\widgets\ActiveForm
 */ ?>
<ul class="nav nav-tabs">
    <li class="active"><a href="#common" data-toggle="tab"><?= Yii::t("NewsModule.news", "General"); ?></a></li>
    <li><a href="#gallery" data-toggle="tab">Галерея</a></li>
    <li><a href="#setting" data-toggle="tab"><?= Yii::t("NewsModule.news", "Произвольные поля"); ?></a></li>
    <li><a href="#seo" data-toggle="tab"><?= Yii::t("NewsModule.news", "SEO"); ?></a></li>
</ul>

<?php
$form = $this->beginWidget(
    '\yupe\widgets\ActiveForm',
    [
        'id' => 'news-form',
        'enableAjaxValidation' => false,
        'enableClientValidation' => true,
        'type' => 'vertical',
        'htmlOptions' => ['class' => 'well', 'enctype' => 'multipart/form-data'],
    ]
); ?>


<?= $form->errorSummary($model); ?>

<div class="tab-content">
    <div class="tab-pane active" id="common">

        <div class="alert alert-info">
            <?= Yii::t('NewsModule.news', 'Fields with'); ?>
            <span class="required">*</span>
            <?= Yii::t('NewsModule.news', 'are required'); ?>
        </div>

        <div class="row">
            <div class="col-sm-3">
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

            <div class="col-sm-2">
                <?= $form->dropDownListGroup(
                    $model,
                    'status',
                    [
                        'widgetOptions' => [
                            'data' => $model->getStatusList(),
                        ],
                    ]
                ); ?>
            </div>

            <div class="col-sm-2">
                <?php if (count($languages) > 1): { ?>
                    <?= $form->dropDownListGroup(
                        $model,
                        'lang',
                        [
                            'widgetOptions' => [
                                'data' => $languages,
                                'htmlOptions' => [
                                    'empty' => Yii::t('NewsModule.news', '-no matter-'),
                                ],
                            ],
                        ]
                    ); ?>
                    <?php if (!$model->isNewRecord): { ?>
                        <?php foreach ($languages as $k => $v): { ?>
                            <?php if ($k !== $model->lang): { ?>
                                <?php if (empty($langModels[$k])): { ?>
                                    <a href="<?= $this->createUrl(
                                        '/news/newsBackend/create',
                                        ['id' => $model->id, 'lang' => $k]
                                    ); ?>"><i class="iconflags iconflags-<?= $k; ?>" title="<?= Yii::t(
                                            'NewsModule.news',
                                            'Add translation for {lang} language',
                                            ['{lang}' => $v]
                                        ) ?>"></i></a>
                                <?php } else: { ?>
                                    <a href="<?= $this->createUrl(
                                        '/news/newsBackend/update',
                                        ['id' => $langModels[$k]]
                                    ); ?>"><i class="iconflags iconflags-<?= $k; ?>" title="<?= Yii::t(
                                            'NewsModule.news',
                                            'Edit translation in to {lang} language',
                                            ['{lang}' => $v]
                                        ) ?>"></i></a>
                                <?php } endif; ?>
                            <?php } endif; ?>
                        <?php } endforeach; ?>
                    <?php } endif; ?>
                <?php } else: { ?>
                    <?= $form->hiddenField($model, 'lang'); ?>
                <?php } endif; ?>
            </div>

        </div>

        <div class="row">
            <div class="col-sm-7">
                <?= $form->dropDownListGroup(
                    $model,
                    'category_id',
                    [
                        'widgetOptions' => [
                            'data' => $model->getCategoryList(),
                            'htmlOptions' => [
                                'empty' => Yii::t('NewsModule.news', '--choose--'),
                                'encode' => false,
                            ],
                        ],
                    ]
                ); ?>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-7">
                <?= $form->dropDownListGroup(
                    $model,
                    'park_id',
                    [
                        'widgetOptions' => [
                            'data' => Park::model()->getListPark(),
                            'htmlOptions' => [
                                'empty' => Yii::t('NewsModule.news', '--choose--'),
                                'encode' => false,
                            ],
                        ],
                    ]
                ); ?>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-7">
                <?= $form->textFieldGroup($model, 'type_news', [
                    'widgetOptions' => [
                        'htmlOptions' => [
                            'class' => 'popover-help',
                            'data-original-title' => $model->getAttributeLabel('type_news'),
                            'data-content' => $model->getAttributeDescription('type_news')
                        ]
                        ]
                ]); ?>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-7">
                <?= $form->textFieldGroup($model, 'title'); ?>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-7">
                <?= $form->slugFieldGroup($model, 'slug', ['sourceAttribute' => 'title']); ?>
            </div>
        </div>

        <div class='row'>
            <div class="col-sm-7">
                <?php
                echo CHtml::image(
                    !$model->isNewRecord && $model->image ? $model->getImageUrl(200, 200) : '#',
                    $model->title,
                    [
                        'class' => 'preview-image img-responsive',
                        'style' => !$model->isNewRecord && $model->image ? '' : 'display:none',
                    ]
                ); ?>

                <?php if (!$model->isNewRecord && $model->image): ?>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox"
                                   name="delete-file"> <?= Yii::t('YupeModule.yupe', 'Delete the file') ?>
                        </label>
                    </div>
                <?php endif; ?>
                
                <code>Рекомендуемый размер изображения 985x529px, вес файла не более 400кб.</code>
                <?= $form->fileFieldGroup(
                    $model,
                    'image',
                    [
                        'widgetOptions' => [
                            'htmlOptions' => [
                                'onchange' => 'readURL(this);',
                                'style' => 'background-color: inherit;',
                            ],
                        ],
                    ]
                ); ?>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12 <?= $model->hasErrors('full_text') ? 'has-error' : ''; ?>">
                <?= $form->labelEx($model, 'full_text'); ?>
                <?php $this->widget(
                    $this->module->getVisualEditor(),
                    [
                        'model' => $model,
                        'attribute' => 'full_text',
                    ]
                ); ?>
                <span class="help-block">
            <?= Yii::t(
                'NewsModule.news',
                'Full text news which will be shown on news article page'
            ); ?>
        </span>
                <?= $form->error($model, 'full_text'); ?>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <?= $form->labelEx($model, 'short_text'); ?>
                <?php $this->widget(
                    $this->module->getVisualEditor(),
                    [
                        'model' => $model,
                        'attribute' => 'short_text',
                    ]
                ); ?>
                <span class="help-block">
            <?= Yii::t(
                'NewsModule.news',
                'News anounce text. Usually this is the main idea of the article.'
            ); ?>
        </span>
                <?= $form->error($model, 'short_text'); ?>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-7">
                <?= $form->textFieldGroup($model, 'link'); ?>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-7">
                <?= $form->checkBoxGroup($model, 'is_protected', $model->getProtectedStatusList()); ?>
            </div>
        </div>
    </div>

    <div class="tab-pane" id="seo">
        <div class="row">
            <div class="col-sm-7">
                <?= $form->textFieldGroup($model, 'meta_title'); ?>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-7">
                <?= $form->textFieldGroup($model, 'meta_keywords'); ?>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-7">
                <?= $form->textAreaGroup($model, 'meta_description'); ?>
            </div>
        </div>
    </div>

    <div class="tab-pane" id="setting">
        <?php $this->renderPartial('application.modules.yupe.views.customFieldBehavior._my-custom-field', ['model' => $model]) ?>
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
                                <?php echo CHtml::fileField("NewsImage[][image]",'', ['multiple'=>true]); ?><br/>
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
                                    <div class="col-md-3 col-sm-4 col-xs-6 imageField-wrapper">
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
                                                                                <?= CHtml::textField('NewsImage['.$image->id.'][title]', $image->title,['class' => 'form-control', 'placeholder' => 'Title']) ?>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-xs-12">
                                                                            <div class="form-group">
                                                                                <?= CHtml::textField('NewsImage['.$image->id.'][alt]', $image->alt,['class' => 'form-control', 'placeholder' => 'Alt']) ?>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-xs-12">
                                                                            <div class="form-group">
                                                                                <?= CHtml::textArea('NewsImage['.$image->id.'][description]', $image->description,['class' => 'form-control', 'placeholder' => 'Описание']) ?>
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
                data-action="<?= Yii::app()->createUrl('/news/newsBackend/sortablephoto') ?>"
                >
                <?= implode('', $keys) ?>
            </div>
        </div>
    </div>
</div>

<br/>

<?php $this->widget(
    'bootstrap.widgets.TbButton',
    [
        'buttonType' => 'submit',
        'context' => 'primary',
        'label' => $model->isNewRecord ? Yii::t('NewsModule.news', 'Create article and continue') : Yii::t(
            'NewsModule.news',
            'Save news article and continue'
        ),
    ]
); ?>

<?php $this->widget(
    'bootstrap.widgets.TbButton',
    [
        'buttonType' => 'submit',
        'htmlOptions' => ['name' => 'submit-type', 'value' => 'index'],
        'label' => $model->isNewRecord ? Yii::t('NewsModule.news', 'Create article and close') : Yii::t(
            'NewsModule.news',
            'Save news article and close'
        ),
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
                url: '<?= Yii::app()->createUrl('/news/newsBackend/deleteImage');?>',
                success: function () {
                    blockForDelete.remove();
                }
            });
        });
    });
</script>

<?php $this->endWidget(); ?>
