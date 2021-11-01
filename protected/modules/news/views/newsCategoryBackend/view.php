<?php
/**
 * Отображение для view:
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
    $model->name,
];

$this->pageTitle = Yii::t('NewsModule.news', 'Категории - просмотр');

$this->menu = [
    ['icon' => 'fa fa-fw fa-list-alt', 'label' => Yii::t('NewsModule.news', 'Управление Категориями'), 'url' => ['/news/newsCategoryBackend/index']],
    ['icon' => 'fa fa-fw fa-plus-square', 'label' => Yii::t('NewsModule.news', 'Добавить Категорию'), 'url' => ['/news/newsCategoryBackend/create']],
    ['label' => Yii::t('NewsModule.news', 'Категория') . ' «' . mb_substr($model->id, 0, 32) . '»'],
    ['icon' => 'fa fa-fw fa-pencil', 'label' => Yii::t('NewsModule.news', 'Редактирование Категории'), 'url' => [
        '/news/newsCategoryBackend/update',
        'id' => $model->id
    ]],
    ['icon' => 'fa fa-fw fa-eye', 'label' => Yii::t('NewsModule.news', 'Просмотреть Категорию'), 'url' => [
        '/news/newsCategoryBackend/view',
        'id' => $model->id
    ]],
    ['icon' => 'fa fa-fw fa-trash-o', 'label' => Yii::t('NewsModule.news', 'Удалить Категорию'), 'url' => '#', 'linkOptions' => [
        'submit' => ['/news/newsCategoryBackend/delete', 'id' => $model->id],
        'confirm' => Yii::t('NewsModule.news', 'Вы уверены, что хотите удалить Категорию?'),
        'csrf' => true,
    ]],
];
?>
<div class="page-header">
    <h1>
        <?=  Yii::t('NewsModule.news', 'Просмотр') . ' ' . Yii::t('NewsModule.news', 'Категории'); ?>        <br/>
        <small>&laquo;<?=  $model->name; ?>&raquo;</small>
    </h1>
</div>

<?php $this->widget('bootstrap.widgets.TbDetailView', [
    'data'       => $model,
    'attributes' => [
        'id',
        'create_user_id',
        'update_user_id',
        'create_time',
        'update_time',
        'name_short',
        'name',
        'slug',
        'description',
        'icon',
        'image',
        'seo_title',
        'seo_keywords',
        'seo_description',
        'status',
        'position',
    ],
]); ?>
