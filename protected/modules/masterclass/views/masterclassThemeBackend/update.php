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
    Yii::t('MasterclassModule.masterclass', 'Темы') => ['/masterclass/masterclassThemeBackend/index'],
    $model->name => ['/masterclass/masterclassThemeBackend/view', 'id' => $model->id],
    Yii::t('MasterclassModule.masterclass', 'Редактирование'),
];

$this->pageTitle = Yii::t('MasterclassModule.masterclass', 'Темы - редактирование');

$this->menu = [
    ['icon' => 'fa fa-fw fa-list-alt', 'label' => Yii::t('MasterclassModule.masterclass', 'Управление Темами'), 'url' => ['/masterclass/masterclassThemeBackend/index']],
    ['icon' => 'fa fa-fw fa-plus-square', 'label' => Yii::t('MasterclassModule.masterclass', 'Добавить Тему'), 'url' => ['/masterclass/masterclassThemeBackend/create']],
    ['label' => Yii::t('MasterclassModule.masterclass', 'Тема') . ' «' . mb_substr($model->id, 0, 32) . '»'],
    ['icon' => 'fa fa-fw fa-pencil', 'label' => Yii::t('MasterclassModule.masterclass', 'Редактирование Темы'), 'url' => [
        '/masterclass/masterclassThemeBackend/update',
        'id' => $model->id
    ]],
    ['icon' => 'fa fa-fw fa-eye', 'label' => Yii::t('MasterclassModule.masterclass', 'Просмотреть Тему'), 'url' => [
        '/masterclass/masterclassThemeBackend/view',
        'id' => $model->id
    ]],
    ['icon' => 'fa fa-fw fa-trash-o', 'label' => Yii::t('MasterclassModule.masterclass', 'Удалить Тему'), 'url' => '#', 'linkOptions' => [
        'submit' => ['/masterclass/masterclassThemeBackend/delete', 'id' => $model->id],
        'confirm' => Yii::t('MasterclassModule.masterclass', 'Вы уверены, что хотите удалить Тему?'),
        'csrf' => true,
    ]],
];
?>
<div class="page-header">
    <h1>
        <?=  Yii::t('MasterclassModule.masterclass', 'Редактирование') . ' ' . Yii::t('MasterclassModule.masterclass', 'Темы'); ?>        <br/>
        <small>&laquo;<?=  $model->name; ?>&raquo;</small>
    </h1>
</div>

<?=  $this->renderPartial('_form', ['model' => $model]); ?>