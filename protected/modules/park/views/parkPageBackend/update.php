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
    Yii::t('ParkModule.park', 'Страницы') => ['/park/ParkPageBackend/index'],
    $model->name => ['/park/ParkPageBackend/view', 'id' => $model->id],
    Yii::t('ParkModule.park', 'Редактирование'),
];

$this->pageTitle = Yii::t('ParkModule.park', 'Страницы - редактирование');

$this->menu = [
    ['icon' => 'fa fa-fw fa-list-alt', 'label' => Yii::t('ParkModule.park', 'Управление Страницыми'), 'url' => ['/park/ParkPageBackend/index']],
    ['icon' => 'fa fa-fw fa-plus-square', 'label' => Yii::t('ParkModule.park', 'Добавить Страницу'), 'url' => ['/park/ParkPageBackend/create']],
    ['label' => Yii::t('ParkModule.park', 'Страницу') . ' «' . mb_substr($model->id, 0, 32) . '»'],
    ['icon' => 'fa fa-fw fa-pencil', 'label' => Yii::t('ParkModule.park', 'Редактирование Страницы'), 'url' => [
        '/park/ParkPageBackend/update',
        'id' => $model->id
    ]],
    ['icon' => 'fa fa-fw fa-eye', 'label' => Yii::t('ParkModule.park', 'Просмотреть Страницу'), 'url' => [
        '/park/ParkPageBackend/view',
        'id' => $model->id
    ]],
    ['icon' => 'fa fa-fw fa-trash-o', 'label' => Yii::t('ParkModule.park', 'Удалить Страницу'), 'url' => '#', 'linkOptions' => [
        'submit' => ['/park/ParkPageBackend/delete', 'id' => $model->id],
        'confirm' => Yii::t('ParkModule.park', 'Вы уверены, что хотите удалить Страницу?'),
        'csrf' => true,
    ]],
];
?>
<div class="page-header">
    <h1>
        <?=  Yii::t('ParkModule.park', 'Редактирование') . ' ' . Yii::t('ParkModule.park', 'Страницы'); ?>        <br/>
        <small>&laquo;<?=  $model->name; ?>&raquo;</small>
    </h1>
</div>

<?=  $this->renderPartial('_form', ['model' => $model]); ?>