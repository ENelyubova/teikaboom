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
    Yii::t('ParkModule.park', 'Парки') => ['/park/parkBackend/index'],
    Yii::t('ParkModule.park', 'Управление'),
];

$this->pageTitle = Yii::t('ParkModule.park', 'Парки - управление');

$this->menu = [
    ['icon' => 'fa fa-fw fa-list-alt', 'label' => Yii::t('ParkModule.park', 'Управление Парками'), 'url' => ['/park/parkBackend/index']],
    ['icon' => 'fa fa-fw fa-plus-square', 'label' => Yii::t('ParkModule.park', 'Добавить Парк'), 'url' => ['/park/parkBackend/create']],
];
?>
<div class="page-header">
    <h1>
        <?=  Yii::t('ParkModule.park', 'Парки'); ?>
        <small><?=  Yii::t('ParkModule.park', 'управление'); ?></small>
    </h1>
</div>

<p>
    <a class="btn btn-default btn-sm dropdown-toggle" data-toggle="collapse" data-target="#search-toggle">
        <i class="fa fa-search">&nbsp;</i>
        <?=  Yii::t('ParkModule.park', 'Поиск Парков');?>
        <span class="caret">&nbsp;</span>
    </a>
</p>

<div id="search-toggle" class="collapse out search-form">
        <?php Yii::app()->clientScript->registerScript('search', "
        $('.search-form form').submit(function () {
            $.fn.yiiGridView.update('park-grid', {
                data: $(this).serialize()
            });

            return false;
        });
    ");
    $this->renderPartial('_search', ['model' => $model]);
?>
</div>

<br/>

<p> <?=  Yii::t('ParkModule.park', 'В данном разделе представлены средства управления Парками'); ?>
</p>

<?php
 $this->widget(
    'yupe\widgets\CustomGridView',
    [
        'id'           => 'park-grid',
        'sortableRows'      => true,
        'sortableAjaxSave'  => true,
        'sortableAttribute' => 'position',
        'sortableAction'    => '/park/parkBackend/sortable',
        'type'         => 'striped condensed',
        'dataProvider' => $model->search(),
        'filter'       => $model,
        'columns'      => [
            'id',
            [
                'name' => 'back',
                'type' => 'raw',
                'value' => function ($data) {
                        return CHtml::link("<span style='padding: 3px 6px; background:{$data->back}; color: #fff'>{$data->back}</span>", ["/store/badgeBackend/update", "id" => $data->id]);
                    },
            ],
            [
                'name' => 'image',
                'type' => 'raw',
                'value' => function ($model) {
                    return CHtml::image($model->getImageNewUrl(0,0,false,null,'image'), $model->image, ["width" => 100, "height" => 100, "class" => "img-thumbnail"]);
                },
            ],
            [
                'name' => 'name_short',
                'type' => 'raw',
                'value' => function ($data) {
                        return CHtml::link(\yupe\helpers\YText::wordLimiter($data->name_short, 5), ["/park/parkBackend/update", "id" => $data->id]);
                    },
            ],
            [
                'name' => 'name',
                'type' => 'raw',
                'value' => function ($data) {
                        return CHtml::link(\yupe\helpers\YText::wordLimiter($data->name, 5), ["/park/parkBackend/update", "id" => $data->id]);
                    },
            ],
            [
                'name' => 'slug',
                'type' => 'raw',
                'value' => function ($data) {
                        return CHtml::link($data->slug, ["/park/parkBackend/update", "id" => $data->id]);
                    },
            ],
            [
                'class' => 'yupe\widgets\EditableStatusColumn',
                'name' => 'status',
                'url' => $this->createUrl('/park/parkBackend/inline'),
                'source' => $model->getStatusList(),
                'options' => [
                    Park::STATUS_PUBLIC => ['class' => 'label-success'],
                    Park::STATUS_MODERATE => ['class' => 'label-default'],
                ],
            ],
            [
                'class' => 'yupe\widgets\CustomButtonColumn',
            ],
        ],
    ]
); ?>
