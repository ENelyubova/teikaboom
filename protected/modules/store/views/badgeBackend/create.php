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
    Yii::t('StoreModule.store', 'Badges') => ['/store/badgeBackend/index'],
    Yii::t('StoreModule.store', 'Добавление'),
];

$this->pageTitle = Yii::t('StoreModule.store', 'Badges - добавление');

$this->menu = [
    ['icon' => 'fa fa-fw fa-list-alt', 'label' => Yii::t('StoreModule.store', 'Управление Badge'), 'url' => ['/store/badgeBackend/index']],
    ['icon' => 'fa fa-fw fa-plus-square', 'label' => Yii::t('StoreModule.store', 'Добавить Badge'), 'url' => ['/store/badgeBackend/create']],
];
?>
<div class="page-header">
    <h1>
        <?=  Yii::t('StoreModule.store', 'Badges'); ?>
        <small><?=  Yii::t('StoreModule.store', 'добавление'); ?></small>
    </h1>
</div>

<?=  $this->renderPartial('_form', ['model' => $model]); ?>