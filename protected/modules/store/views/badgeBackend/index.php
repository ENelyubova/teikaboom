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
    Yii::t('StoreModule.store', 'Badges') => ['/store/badgeBackend/index'],
    Yii::t('StoreModule.store', 'Управление'),
];

$this->pageTitle = Yii::t('StoreModule.store', 'Badges - управление');

$this->menu = [
    ['icon' => 'fa fa-fw fa-list-alt', 'label' => Yii::t('StoreModule.store', 'Управление Badge'), 'url' => ['/store/badgeBackend/index']],
    ['icon' => 'fa fa-fw fa-plus-square', 'label' => Yii::t('StoreModule.store', 'Добавить Badge'), 'url' => ['/store/badgeBackend/create']],
];
?>
<div class="page-header">
    <h1>
        <?=  Yii::t('StoreModule.store', 'Badges'); ?>
        <small><?=  Yii::t('StoreModule.store', 'управление'); ?></small>
    </h1>
</div>

<p>
    <a class="btn btn-default btn-sm dropdown-toggle" data-toggle="collapse" data-target="#search-toggle">
        <i class="fa fa-search">&nbsp;</i>
        <?=  Yii::t('StoreModule.store', 'Поиск Badge');?>
        <span class="caret">&nbsp;</span>
    </a>
</p>

<div id="search-toggle" class="collapse out search-form">
        <?php Yii::app()->clientScript->registerScript('search', "
        $('.search-form form').submit(function () {
            $.fn.yiiGridView.update('badge-grid', {
                data: $(this).serialize()
            });

            return false;
        });
    ");
    $this->renderPartial('_search', ['model' => $model]);
?>
</div>

<br/>

<p> <?=  Yii::t('StoreModule.store', 'В данном разделе представлены средства управления Badge'); ?>
</p>

<?php
 $this->widget(
    'yupe\widgets\CustomGridView',
    [
        'id'           => 'badge-grid',
        'sortableRows'      => true,
        'sortableAjaxSave'  => true,
        'sortableAttribute' => 'position',
        'sortableAction'    => '/store/badgeBackend/sortable',
        'type' => 'condensed',
        'dataProvider' => $model->search(),
        'filter' => $model,
        'columns'      => [
            'id',
            [
                'name' => 'name',
                'type' => 'raw',
                'value' => function ($data) {
                        return CHtml::link("<span style='padding: 3px 6px; background:{$data->background}; color: {$data->color}'>{$data->name}</span>", ["/store/badgeBackend/update", "id" => $data->id]);
                    },
            ],
            [
                'class' => 'yupe\widgets\EditableStatusColumn',
                'name' => 'status',
                'url' => $this->createUrl('/store/badgeBackend/inline'),
                'source' => $model->getStatusList(),
                'options' => [
                    Badge::STATUS_PUBLIC => ['class' => 'label-success'],
                    Badge::STATUS_MODERATE => ['class' => 'label-default'],
                ],
            ],
            [
                'class' => 'yupe\widgets\CustomButtonColumn',
            ],
        ],
    ]
); ?>
