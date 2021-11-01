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
    Yii::t('NewsModule.news', 'Категории') => ['/news/newsCategoryBackend/index'],
    Yii::t('NewsModule.news', 'Добавление'),
];

$this->pageTitle = Yii::t('NewsModule.news', 'Категории - добавление');

$this->menu = [
    ['icon' => 'fa fa-fw fa-list-alt', 'label' => Yii::t('NewsModule.news', 'Управление Категориями'), 'url' => ['/news/newsCategoryBackend/index']],
    ['icon' => 'fa fa-fw fa-plus-square', 'label' => Yii::t('NewsModule.news', 'Добавить Категорию'), 'url' => ['/news/newsCategoryBackend/create']],
];
?>
<div class="page-header">
    <h1>
        <?=  Yii::t('NewsModule.news', 'Категории'); ?>
        <small><?=  Yii::t('NewsModule.news', 'добавление'); ?></small>
    </h1>
</div>

<?=  $this->renderPartial('_form', ['model' => $model]); ?>