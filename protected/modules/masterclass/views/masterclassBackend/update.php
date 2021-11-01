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
    Yii::t('MasterclassModule.masterclass', 'Мастер классы') => ['/masterclass/masterclassBackend/index'],
    $model->name => ['/masterclass/masterclassBackend/view', 'id' => $model->id],
    Yii::t('MasterclassModule.masterclass', 'Редактирование'),
];

$this->pageTitle = Yii::t('MasterclassModule.masterclass', 'Мастер классы - редактирование');

$this->menu = [
    ['icon' => 'fa fa-fw fa-list-alt', 'label' => Yii::t('MasterclassModule.masterclass', 'Управление Мастер классами'), 'url' => ['/masterclass/masterclassBackend/index']],
    ['icon' => 'fa fa-fw fa-plus-square', 'label' => Yii::t('MasterclassModule.masterclass', 'Добавить Мастер класс'), 'url' => ['/masterclass/masterclassBackend/create']],
    ['label' => Yii::t('MasterclassModule.masterclass', 'Мастер класс') . ' «' . mb_substr($model->id, 0, 32) . '»'],
    ['icon' => 'fa fa-fw fa-pencil', 'label' => Yii::t('MasterclassModule.masterclass', 'Редактирование Мастер класса'), 'url' => [
        '/masterclass/masterclassBackend/update',
        'id' => $model->id
    ]],
    ['icon' => 'fa fa-fw fa-eye', 'label' => Yii::t('MasterclassModule.masterclass', 'Просмотреть Мастер класс'), 'url' => [
        '/masterclass/masterclassBackend/view',
        'id' => $model->id
    ]],
    ['icon' => 'fa fa-fw fa-trash-o', 'label' => Yii::t('MasterclassModule.masterclass', 'Удалить Мастер класс'), 'url' => '#', 'linkOptions' => [
        'submit' => ['/masterclass/masterclassBackend/delete', 'id' => $model->id],
        'confirm' => Yii::t('MasterclassModule.masterclass', 'Вы уверены, что хотите удалить Мастер класс?'),
        'csrf' => true,
    ]],
];
?>
<div class="page-header">
    <h1>
        <?=  Yii::t('MasterclassModule.masterclass', 'Редактирование') . ' ' . Yii::t('MasterclassModule.masterclass', 'Мастер класса'); ?>        <br/>
        <small>&laquo;<?=  $model->name; ?>&raquo;</small>
    </h1>
</div>

<?=  $this->renderPartial('_form', ['model' => $model]); ?>