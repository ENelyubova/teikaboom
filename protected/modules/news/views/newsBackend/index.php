<?php

/**
 * @var $model News
 * @var $this NewsBackendController
 */

$this->breadcrumbs = [
    Yii::t('NewsModule.news', 'News') => ['/news/newsBackend/index'],
    Yii::t('NewsModule.news', 'Management'),
];

$this->pageTitle = Yii::t('NewsModule.news', 'News - management');

$this->menu = [
    [
        'icon' => 'fa fa-fw fa-list-alt',
        'label' => Yii::t('NewsModule.news', 'News management'),
        'url' => ['/news/newsBackend/index'],
    ],
    [
        'icon' => 'fa fa-fw fa-plus-square',
        'label' => Yii::t('NewsModule.news', 'Create news'),
        'url' => ['/news/newsBackend/create'],
    ],
];
?>
<div class="page-header">
    <h1>
        <?= Yii::t('NewsModule.news', 'News'); ?>
        <small><?= Yii::t('NewsModule.news', 'management'); ?></small>
    </h1>
</div>

<p>
    <a class="btn btn-default btn-sm dropdown-toggle" data-toggle="collapse" data-target="#search-toggle">
        <i class="fa fa-search">&nbsp;</i>
        <?= Yii::t('NewsModule.news', 'Find news'); ?>
        <span class="caret">&nbsp;</span>
    </a>
</p>

<div id="search-toggle" class="collapse out search-form">
    <?php
    Yii::app()->clientScript->registerScript(
        'search',
        "
    $('.search-form form').submit(function () {
        $.fn.yiiGridView.update('news-grid', {
            data: $(this).serialize()
        });

        return false;
    });
"
    );
    $this->renderPartial('_search', ['model' => $model]);
    ?>
</div>

<?php $this->widget(
    'yupe\widgets\CustomGridView',
    [
        'id' => 'news-grid',
        'dataProvider' => $model->search(),
        'filter' => $model,
        'columns' => [
            [
                'name' => 'image',
                'type' => 'raw',
                'value' => function ($model) {
                    return CHtml::image($model->getImageNewUrl(100,100,false,null,'image'), $model->image, ["width" => 100, "height" => 100, "class" => "img-thumbnail"]);
                },
            ],
            [
                'class' => 'bootstrap.widgets.TbEditableColumn',
                'name' => 'title',
                'editable' => [
                    'url' => $this->createUrl('/news/newsBackend/inline'),
                    'mode' => 'inline',
                    'params' => [
                        Yii::app()->request->csrfTokenName => Yii::app()->request->csrfToken,
                    ],
                ],
                'filter' => CHtml::activeTextField($model, 'title', ['class' => 'form-control']),
            ],
            [
                'class' => 'bootstrap.widgets.TbEditableColumn',
                'name' => 'slug',
                'editable' => [
                    'url' => $this->createUrl('/news/newsBackend/inline'),
                    'mode' => 'inline',
                    'params' => [
                        Yii::app()->request->csrfTokenName => Yii::app()->request->csrfToken,
                    ],
                ],
                'filter' => CHtml::activeTextField($model, 'slug', ['class' => 'form-control']),
            ],
            'date',
            [
                'name' => 'park_id',
                'value' => function($data){
                    $parkList = '<span class="label label-primary">'. (isset($data->park) ? $data->park->name : '---') . '</span>';

                    return $parkList;
                },
                'type' => 'raw',
                'filter' => CHtml::activeDropDownList(
                    $model,
                    'park_id',
                    Park::model()->getListPark(),
                    ['class' => 'form-control', 'encode' => false, 'empty' => '', 'style' => 'min-width: 100px']
                ),
            ],
            [
                'name' => 'category_id',
                'value' => '$data->getCategoryName()',
                'filter' => CHtml::activeDropDownList(
                    $model,
                    'category_id',
                    $model->getCategoryList(),
                    ['class' => 'form-control', 'encode' => false, 'empty' => '']
                ),
            ],
            [
                'class' => 'yupe\widgets\EditableStatusColumn',
                'name' => 'status',
                'url' => $this->createUrl('/news/newsBackend/inline'),
                'source' => $model->getStatusList(),
                'options' => [
                    News::STATUS_PUBLISHED => ['class' => 'label-success'],
                    News::STATUS_MODERATION => ['class' => 'label-warning'],
                    News::STATUS_DRAFT => ['class' => 'label-default'],
                ],
            ],
            [
                'name' => 'lang',
                'value' => '$data->getFlag()',
                'filter' => $this->yupe->getLanguagesList(),
                'type' => 'html',
            ],
            [
                'class' => 'yupe\widgets\CustomButtonColumn',
                'frontViewButtonUrl' => function ($data) {
                    return Yii::app()->createUrl('/news/news/view', ['slug' => $data->slug]);
                },
                'buttons' => [
                    'front_view' => [
                        'visible' => function ($row, $data) {
                            return $data->status == News::STATUS_PUBLISHED;
                        },
                    ],
                ],
            ],
        ],
    ]
); ?>
