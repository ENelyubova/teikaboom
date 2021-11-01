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
    Yii::t('StoreModule.store', 'Badges') => ['/store/badgeBackend/index'],
    $model->name => ['/store/badgeBackend/view', 'id' => $model->id],
    Yii::t('StoreModule.store', 'Редактирование'),
];

$this->pageTitle = Yii::t('StoreModule.store', 'Badges - редактирование');

$this->menu = [
    ['icon' => 'fa fa-fw fa-list-alt', 'label' => Yii::t('StoreModule.store', 'Управление Badge'), 'url' => ['/store/badgeBackend/index']],
    ['icon' => 'fa fa-fw fa-plus-square', 'label' => Yii::t('StoreModule.store', 'Добавить Badge'), 'url' => ['/store/badgeBackend/create']],
    ['label' => Yii::t('StoreModule.store', 'Badge') . ' «' . mb_substr($model->id, 0, 32) . '»'],
    ['icon' => 'fa fa-fw fa-pencil', 'label' => Yii::t('StoreModule.store', 'Редактирование Badge'), 'url' => [
        '/store/badgeBackend/update',
        'id' => $model->id
    ]],
    ['icon' => 'fa fa-fw fa-eye', 'label' => Yii::t('StoreModule.store', 'Просмотреть Badge'), 'url' => [
        '/store/badgeBackend/view',
        'id' => $model->id
    ]],
    ['icon' => 'fa fa-fw fa-trash-o', 'label' => Yii::t('StoreModule.store', 'Удалить Badge'), 'url' => '#', 'linkOptions' => [
        'submit' => ['/store/badgeBackend/delete', 'id' => $model->id],
        'confirm' => Yii::t('StoreModule.store', 'Вы уверены, что хотите удалить Badge?'),
        'csrf' => true,
    ]],
];
?>
<div class="page-header">
    <h1>
        <?=  Yii::t('StoreModule.store', 'Редактирование') . ' ' . Yii::t('StoreModule.store', 'Badge'); ?>        <br/>
        <small>&laquo;<?=  $model->name; ?>&raquo;</small>
    </h1>
</div>

<?=  $this->renderPartial('_form', ['model' => $model]); ?>