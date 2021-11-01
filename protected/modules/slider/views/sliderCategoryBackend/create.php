<?php
/**
 * Отображение для create:
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
    Yii::t('SliderModule.slider', 'Добавление'),
];

$this->pageTitle = Yii::t('SliderModule.slider', 'Категории - добавление');

$this->menu = [
    ['icon' => 'fa fa-fw fa-list-alt', 'label' => Yii::t('SliderModule.slider', 'Управление Категориями'), 'url' => ['/slider/sliderCategoryBackend/index']],
    ['icon' => 'fa fa-fw fa-plus-square', 'label' => Yii::t('SliderModule.slider', 'Добавить Категорию'), 'url' => ['/slider/sliderCategoryBackend/create']],
];
?>
<div class="page-header">
    <h1>
        <?=  Yii::t('SliderModule.slider', 'Категории'); ?>
        <small><?=  Yii::t('SliderModule.slider', 'добавление'); ?></small>
    </h1>
</div>

<?=  $this->renderPartial('_form', ['model' => $model]); ?>