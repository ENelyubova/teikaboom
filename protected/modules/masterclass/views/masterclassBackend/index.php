<?php
/**
 * Отображение для index:
 *
 *   @category YupeView
 *   @package  yupe
 *   @author   Yupe Team <team@yupe.ru>
 *   @license  https://github.com/yupe/yupe/blob/master/LICENSE BSD
 *   @link     https://yupe.ru
 **/
$this->breadcrumbs = [
    $this->getModule()->getCategory() => [],
    Yii::t('MasterclassModule.masterclass', 'Мастер классы') => ['/masterclass/masterclassBackend/index'],
    Yii::t('MasterclassModule.masterclass', 'Управление'),
];

$this->pageTitle = Yii::t('MasterclassModule.masterclass', 'Мастер классы - управление');

$this->menu = [
    ['icon' => 'fa fa-fw fa-list-alt', 'label' => Yii::t('MasterclassModule.masterclass', 'Управление Мастер классами'), 'url' => ['/masterclass/masterclassBackend/index']],
    ['icon' => 'fa fa-fw fa-plus-square', 'label' => Yii::t('MasterclassModule.masterclass', 'Добавить Мастер класс'), 'url' => ['/masterclass/masterclassBackend/create']],
];
?>
<div class="page-header">
    <h1>
        <?=  Yii::t('MasterclassModule.masterclass', 'Мастер классы'); ?>
        <small><?=  Yii::t('MasterclassModule.masterclass', 'управление'); ?></small>
    </h1>
</div>

<p>
    <a class="btn btn-default btn-sm dropdown-toggle" data-toggle="collapse" data-target="#search-toggle">
        <i class="fa fa-search">&nbsp;</i>
        <?=  Yii::t('MasterclassModule.masterclass', 'Поиск Мастер классов');?>
        <span class="caret">&nbsp;</span>
    </a>
</p>

<div id="search-toggle" class="collapse out search-form">
        <?php Yii::app()->clientScript->registerScript('search', "
        $('.search-form form').submit(function () {
            $.fn.yiiGridView.update('masterclass-grid', {
                data: $(this).serialize()
            });

            return false;
        });
    ");
    $this->renderPartial('_search', ['model' => $model]);
?>
</div>

<br/>

<p> <?=  Yii::t('MasterclassModule.masterclass', 'В данном разделе представлены средства управления Мастер классами'); ?>
</p>

<?php
 $this->widget(
    'yupe\widgets\CustomGridView',
    [
        'id'           => 'masterclass-grid',
        'sortableRows'      => true,
        'sortableAjaxSave'  => true,
        'sortableAttribute' => 'position',
        'sortableAction'    => '/masterclass/masterclassBackend/sortableMasterclass',
        'type'         => 'striped condensed',
        'dataProvider' => $model->search(),
        'filter'       => $model,
        'columns'      => [
            'id',
            [
                'name' => 'image',
                'type' => 'raw',
                'value' => function ($model) {
                    return CHtml::image($model->getImageNewUrl(0,0,false,null,'image'), $model->image, ["width" => 100, "height" => 100, "class" => "img-thumbnail"]);
                },
            ],
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
                'name' => 'theme_id',
                'value' => function($data){
                    $themeList = '<span class="label label-primary">'. (isset($data->theme) ? $data->theme->name : '---') . '</span>';

                    return $themeList;
                },
                'type' => 'raw',
                'filter' => CHtml::activeDropDownList(
                    $model,
                    'theme_id',
                    MasterclassTheme::model()->getThemeList(),
                    ['class' => 'form-control', 'encode' => false, 'empty' => '', 'style' => 'min-width: 100px']
                ),
            ],
            [
                'name' => 'name',
                'type' => 'raw',
                'value' => function ($data) {
                        return CHtml::link(\yupe\helpers\YText::wordLimiter($data->name, 5), ["/masterclass/masterclassBackend/update", "id" => $data->id]);
                    },
            ],
            [
                'name' => 'slug',
                'type' => 'raw',
                'value' => function ($data) {
                        return CHtml::link($data->slug, ["/masterclass/masterclassBackend/update", "id" => $data->id]);
                    },
            ],
            [
                'class' => 'bootstrap.widgets.TbEditableColumn',
                'name' => 'price',
                'value' => function ($data) {
                    return round($data->price, 2);
                },
                'editable' => [
                    'url' => $this->createUrl('/masterclass/masterclassBackend/inline'),
                    'mode' => 'inline',
                    'params' => [
                        Yii::app()->getRequest()->csrfTokenName => Yii::app()->getRequest()->csrfToken
                    ]
                ],
                'filter' => CHtml::activeTextField($model, 'price', ['class' => 'form-control']),
            ],
            'duration',
            'age',
            [
                'class' => 'yupe\widgets\EditableStatusColumn',
                'name' => 'status',
                'url' => $this->createUrl('/masterclass/masterclassBackend/inline'),
                'source' => $model->getStatusList(),
                'options' => [
                    Masterclass::STATUS_PUBLIC => ['class' => 'label-success'],
                    Masterclass::STATUS_MODERATE => ['class' => 'label-default'],
                ],
            ],
            [
                'class' => 'yupe\widgets\CustomButtonColumn',
            ],
        ],
    ]
); ?>
