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
    Yii::t('MasterclassModule.masterclass', 'Мастер классы') => ['/masterclass/masterclassBackend/index'],
    Yii::t('MasterclassModule.masterclass', 'Добавление'),
];

$this->pageTitle = Yii::t('MasterclassModule.masterclass', 'Мастер классы - добавление');

$this->menu = [
    ['icon' => 'fa fa-fw fa-list-alt', 'label' => Yii::t('MasterclassModule.masterclass', 'Управление Мастер классами'), 'url' => ['/masterclass/masterclassBackend/index']],
    ['icon' => 'fa fa-fw fa-plus-square', 'label' => Yii::t('MasterclassModule.masterclass', 'Добавить Мастер класс'), 'url' => ['/masterclass/masterclassBackend/create']],
];
?>
<div class="page-header">
    <h1>
        <?=  Yii::t('MasterclassModule.masterclass', 'Мастер классы'); ?>
        <small><?=  Yii::t('MasterclassModule.masterclass', 'добавление'); ?></small>
    </h1>
</div>

<?=  $this->renderPartial('_form', ['model' => $model]); ?>