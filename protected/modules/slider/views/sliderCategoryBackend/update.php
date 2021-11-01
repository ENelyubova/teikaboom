<?php
/**
 * Отображение для update:
 *
 *   @category YupeView
 *   @package  yupe
 *   @author   Yupe Team <team@yupe.ru>
 *   @license  https://github.com/yupe/yupe/blob/master/LICENSE BSD
 *   @link     https://yupe.ru
 **/
$this->breadcrumbs = [
    $this->getModule()->getCategory() => [],
    Yii::t('SliderModule.slider', 'Категории') => ['/slider/sliderCategoryBackend/index'],
    $model->name => ['/slider/sliderCategoryBackend/view', 'id' => $model->id],
    Yii::t('SliderModule.slider', 'Редактирование'),
];

$this->pageTitle = Yii::t('SliderModule.slider', 'Категории - редактирование');

$this->menu = [
    ['icon' => 'fa fa-fw fa-list-alt', 'label' => Yii::t('SliderModule.slider', 'Управление Категориями'), 'url' => ['/slider/sliderCategoryBackend/index']],
    ['icon' => 'fa fa-fw fa-plus-square', 'label' => Yii::t('SliderModule.slider', 'Добавить Категорию'), 'url' => ['/slider/sliderCategoryBackend/create']],
    ['label' => Yii::t('SliderModule.slider', 'Категория') . ' «' . mb_substr($model->id, 0, 32) . '»'],
    ['icon' => 'fa fa-fw fa-pencil', 'label' => Yii::t('SliderModule.slider', 'Редактирование Категории'), 'url' => [
        '/slider/sliderCategoryBackend/update',
        'id' => $model->id
    ]],
    ['icon' => 'fa fa-fw fa-eye', 'label' => Yii::t('SliderModule.slider', 'Просмотреть Категорию'), 'url' => [
        '/slider/sliderCategoryBackend/view',
        'id' => $model->id
    ]],
    ['icon' => 'fa fa-fw fa-trash-o', 'label' => Yii::t('SliderModule.slider', 'Удалить Категорию'), 'url' => '#', 'linkOptions' => [
        'submit' => ['/slider/sliderCategoryBackend/delete', 'id' => $model->id],
        'confirm' => Yii::t('SliderModule.slider', 'Вы уверены, что хотите удалить Категорию?'),
        'csrf' => true,
    ]],
];
?>
<div class="page-header">
    <h1>
        <?=  Yii::t('SliderModule.slider', 'Редактирование') . ' ' . Yii::t('SliderModule.slider', 'Категории'); ?>        <br/>
        <small>&laquo;<?=  $model->name; ?>&raquo;</small>
    </h1>
</div>

<?=  $this->renderPartial('_form', ['model' => $model]); ?>