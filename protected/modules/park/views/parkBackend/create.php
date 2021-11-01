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
    Yii::t('ParkModule.park', 'Парки') => ['/park/parkBackend/index'],
    Yii::t('ParkModule.park', 'Добавление'),
];

$this->pageTitle = Yii::t('ParkModule.park', 'Парки - добавление');

$this->menu = [
    ['icon' => 'fa fa-fw fa-list-alt', 'label' => Yii::t('ParkModule.park', 'Управление Парками'), 'url' => ['/park/parkBackend/index']],
    ['icon' => 'fa fa-fw fa-plus-square', 'label' => Yii::t('ParkModule.park', 'Добавить Парк'), 'url' => ['/park/parkBackend/create']],
];
?>
<div class="page-header">
    <h1>
        <?=  Yii::t('ParkModule.park', 'Парки'); ?>
        <small><?=  Yii::t('ParkModule.park', 'добавление'); ?></small>
    </h1>
</div>

<?=  $this->renderPartial('_form', ['model' => $model]); ?>