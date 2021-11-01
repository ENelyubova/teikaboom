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
    Yii::t('NewsModule.news', 'Категории') => ['/news/newsCategoryBackend/index'],
    Yii::t('NewsModule.news', 'Управление'),
];

$this->pageTitle = Yii::t('NewsModule.news', 'Категории - управление');

$this->menu = [
    ['icon' => 'fa fa-fw fa-list-alt', 'label' => Yii::t('NewsModule.news', 'Управление Категориями'), 'url' => ['/news/newsCategoryBackend/index']],
    ['icon' => 'fa fa-fw fa-plus-square', 'label' => Yii::t('NewsModule.news', 'Добавить Категорию'), 'url' => ['/news/newsCategoryBackend/create']],
];
?>
<div class="page-header">
    <h1>
        <?=  Yii::t('NewsModule.news', 'Категории'); ?>
        <small><?=  Yii::t('NewsModule.news', 'управление'); ?></small>
    </h1>
</div>

<p>
    <a class="btn btn-default btn-sm dropdown-toggle" data-toggle="collapse" data-target="#search-toggle">
        <i class="fa fa-search">&nbsp;</i>
        <?=  Yii::t('NewsModule.news', 'Поиск Категорий');?>
        <span class="caret">&nbsp;</span>
    </a>
</p>

<div id="search-toggle" class="collapse out search-form">
        <?php Yii::app()->clientScript->registerScript('search', "
        $('.search-form form').submit(function () {
            $.fn.yiiGridView.update('news-category-grid', {
                data: $(this).serialize()
            });

            return false;
        });
    ");
    $this->renderPartial('_search', ['model' => $model]);
?>
</div>

<br/>

<p> <?=  Yii::t('NewsModule.news', 'В данном разделе представлены средства управления Категориями'); ?>
</p>

<?php
 $this->widget(
    'yupe\widgets\CustomGridView',
    [
        'id'           => 'news-category-grid',
        'sortableRows'      => true,
        'sortableAjaxSave'  => true,
        'sortableAttribute' => 'position',
        'sortableAction'    => '/news/newsCategoryBackend/sortable',
        'dataProvider' => $model->search(),
        'filter'       => $model,
        'columns'      => [
            'id',
            [
                'name' => 'image',
                'type' => 'raw',
                'value' => function ($model) {
                    return CHtml::image($model->getImageUrl(), $model->image, ["width" => 70, "height" => 70, "class" => "img-thumbnail"]);
                },
            ],
            'name_short',
            [
                'name' => 'name',
                'type' => 'raw',
                'value' => function ($data) {
                        return CHtml::link(\yupe\helpers\YText::wordLimiter($data->name, 5), ["/news/newsCategoryBackend/update", "id" => $data->id]);
                    },
            ],
            [
                'class' => 'yupe\widgets\EditableStatusColumn',
                'name' => 'status',
                'url' => $this->createUrl('/news/newsCategoryBackend/inline'),
                'source' => $model->getStatusList(),
                'options' => [
                    NewsCategory::STATUS_PUBLIC => ['class' => 'label-success'],
                    NewsCategory::STATUS_MODERATE => ['class' => 'label-default'],
                ],
            ],
            [
                'class' => 'yupe\widgets\CustomButtonColumn',
            ],
        ],
    ]
); ?>
