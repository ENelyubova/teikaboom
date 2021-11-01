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
    Yii::t('ParkModule.park', 'Страницы') => ['/park/ParkPageBackend/index'],
    Yii::t('ParkModule.park', 'Управление'),
];

$this->pageTitle = Yii::t('ParkModule.park', 'Страницы - управление');

$this->menu = [
    ['icon' => 'fa fa-fw fa-list-alt', 'label' => Yii::t('ParkModule.park', 'Управление Страницыми'), 'url' => ['/park/ParkPageBackend/index']],
    ['icon' => 'fa fa-fw fa-plus-square', 'label' => Yii::t('ParkModule.park', 'Добавить Страницу'), 'url' => ['/park/ParkPageBackend/create']],
];
?>
<div class="page-header">
    <h1>
        <?=  Yii::t('ParkModule.park', 'Страницы'); ?>
        <small><?=  Yii::t('ParkModule.park', 'управление'); ?></small>
    </h1>
</div>

<p>
    <a class="btn btn-default btn-sm dropdown-toggle" data-toggle="collapse" data-target="#search-toggle">
        <i class="fa fa-search">&nbsp;</i>
        <?=  Yii::t('ParkModule.park', 'Поиск Страницуов');?>
        <span class="caret">&nbsp;</span>
    </a>
</p>

<div id="search-toggle" class="collapse out search-form">
        <?php Yii::app()->clientScript->registerScript('search', "
        $('.search-form form').submit(function () {
            $.fn.yiiGridView.update('park-page-grid', {
                data: $(this).serialize()
            });

            return false;
        });
    ");
    $this->renderPartial('_search', ['model' => $model]);
?>
</div>

<br/>

<p> <?=  Yii::t('ParkModule.park', 'В данном разделе представлены средства управления Страницыми'); ?>
</p>

<?php
 $this->widget(
    'yupe\widgets\CustomGridView',
    [
        'id'           => 'park-page-grid',
        'sortableRows'      => true,
        'sortableAjaxSave'  => true,
        'sortableAttribute' => 'position',
        'sortableAction'    => '/park/parkPageBackend/sortable',
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
                'name' => 'parent_id',
                'value' => function($data){
                    $pageList = '<span class="label label-primary">'. (isset($data->parentPage) ? $data->parentPage->name : '---') . '</span>';

                    return $pageList;
                },
                'type' => 'raw',
                'filter' => CHtml::activeDropDownList(
                    $model,
                    'parent_id',
                    $model->getFormattedList(),
                    ['class' => 'form-control', 'encode' => false, 'empty' => '', 'style' => 'min-width: 100px']
                ),
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
                'name' => 'name_short',
                'type' => 'raw',
                'value' => function ($data) {
                        return CHtml::link(\yupe\helpers\YText::wordLimiter($data->name_short, 5), ["/park/ParkPageBackend/update", "id" => $data->id]);
                    },
            ],
            [
                'name' => 'name',
                'type' => 'raw',
                'value' => function ($data) {
                        return CHtml::link(\yupe\helpers\YText::wordLimiter($data->name, 5), ["/park/ParkPageBackend/update", "id" => $data->id]);
                    },
            ],
            [
                'name' => 'slug',
                'type' => 'raw',
                'value' => function ($data) {
                        return CHtml::link($data->slug, ["/park/ParkPageBackend/update", "id" => $data->id]);
                    },
            ],
            [
                'class' => 'yupe\widgets\EditableStatusColumn',
                'name' => 'status',
                'url' => $this->createUrl('/park/ParkPageBackend/inline'),
                'source' => $model->getStatusList(),
                'options' => [
                    ParkPage::STATUS_PUBLIC => ['class' => 'label-success'],
                    ParkPage::STATUS_MODERATE => ['class' => 'label-default'],
                ],
            ],
            [
                'class' => 'yupe\widgets\CustomButtonColumn',
            ],
        ],
    ]
); ?>
