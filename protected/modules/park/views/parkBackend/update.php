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
    Yii::t('ParkModule.park', 'Парки') => ['/park/parkBackend/index'],
    $model->name => ['/park/parkBackend/view', 'id' => $model->id],
    Yii::t('ParkModule.park', 'Редактирование'),
];

$this->pageTitle = Yii::t('ParkModule.park', 'Парки - редактирование');

$this->menu = [
    ['icon' => 'fa fa-fw fa-list-alt', 'label' => Yii::t('ParkModule.park', 'Управление Парками'), 'url' => ['/park/parkBackend/index']],
    ['icon' => 'fa fa-fw fa-plus-square', 'label' => Yii::t('ParkModule.park', 'Добавить Парк'), 'url' => ['/park/parkBackend/create']],
    ['label' => Yii::t('ParkModule.park', 'Парк') . ' «' . mb_substr($model->id, 0, 32) . '»'],
    ['icon' => 'fa fa-fw fa-pencil', 'label' => Yii::t('ParkModule.park', 'Редактирование Парка'), 'url' => [
        '/park/parkBackend/update',
        'id' => $model->id
    ]],
    ['icon' => 'fa fa-fw fa-eye', 'label' => Yii::t('ParkModule.park', 'Просмотреть Парк'), 'url' => [
        '/park/parkBackend/view',
        'id' => $model->id
    ]],
    ['icon' => 'fa fa-fw fa-trash-o', 'label' => Yii::t('ParkModule.park', 'Удалить Парк'), 'url' => '#', 'linkOptions' => [
        'submit' => ['/park/parkBackend/delete', 'id' => $model->id],
        'confirm' => Yii::t('ParkModule.park', 'Вы уверены, что хотите удалить Парк?'),
        'csrf' => true,
    ]],
];
?>
<div class="page-header">
    <h1>
        <?=  Yii::t('ParkModule.park', 'Редактирование') . ' ' . Yii::t('ParkModule.park', 'Парка'); ?>        <br/>
        <small>&laquo;<?=  $model->name; ?>&raquo;</small>
    </h1>
</div>

<?=  $this->renderPartial('_form', ['model' => $model]); ?>