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
    Yii::t('MasterclassModule.masterclass', 'Темы') => ['/masterclass/masterclassThemeBackend/index'],
    Yii::t('MasterclassModule.masterclass', 'Добавление'),
];

$this->pageTitle = Yii::t('MasterclassModule.masterclass', 'Темы - добавление');

$this->menu = [
    ['icon' => 'fa fa-fw fa-list-alt', 'label' => Yii::t('MasterclassModule.masterclass', 'Управление Темами'), 'url' => ['/masterclass/masterclassThemeBackend/index']],
    ['icon' => 'fa fa-fw fa-plus-square', 'label' => Yii::t('MasterclassModule.masterclass', 'Добавить Тему'), 'url' => ['/masterclass/masterclassThemeBackend/create']],
];
?>
<div class="page-header">
    <h1>
        <?=  Yii::t('MasterclassModule.masterclass', 'Темы'); ?>
        <small><?=  Yii::t('MasterclassModule.masterclass', 'добавление'); ?></small>
    </h1>
</div>

<?=  $this->renderPartial('_form', ['model' => $model]); ?>