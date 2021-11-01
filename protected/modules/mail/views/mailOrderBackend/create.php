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
    Yii::t('MailModule.mail', 'Заявки') => ['/mail/mailOrderBackend/index'],
    Yii::t('MailModule.mail', 'Добавление'),
];

$this->pageTitle = Yii::t('MailModule.mail', 'Заявки - добавление');

$this->menu = [
    ['icon' => 'fa fa-fw fa-list-alt', 'label' => Yii::t('MailModule.mail', 'Управление Заявками'), 'url' => ['/mail/mailOrderBackend/index']],
    ['icon' => 'fa fa-fw fa-plus-square', 'label' => Yii::t('MailModule.mail', 'Добавить Заявку'), 'url' => ['/mail/mailOrderBackend/create']],
];
?>
<div class="page-header">
    <h1>
        <?=  Yii::t('MailModule.mail', 'Заявки'); ?>
        <small><?=  Yii::t('MailModule.mail', 'добавление'); ?></small>
    </h1>
</div>

<?=  $this->renderPartial('_form', ['model' => $model]); ?>