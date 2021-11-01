<?php
/**
 * Отображение для view:
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
    $model->name,
];

$this->pageTitle = Yii::t('MailModule.mail', 'Заявки - просмотр');

$this->menu = [
    ['icon' => 'fa fa-fw fa-list-alt', 'label' => Yii::t('MailModule.mail', 'Управление Заявками'), 'url' => ['/mail/mailOrderBackend/index']],
    ['icon' => 'fa fa-fw fa-plus-square', 'label' => Yii::t('MailModule.mail', 'Добавить Заявку'), 'url' => ['/mail/mailOrderBackend/create']],
    ['label' => Yii::t('MailModule.mail', 'Заявка') . ' «' . mb_substr($model->id, 0, 32) . '»'],
    ['icon' => 'fa fa-fw fa-pencil', 'label' => Yii::t('MailModule.mail', 'Редактирование Заявки'), 'url' => [
        '/mail/mailOrderBackend/update',
        'id' => $model->id
    ]],
    ['icon' => 'fa fa-fw fa-eye', 'label' => Yii::t('MailModule.mail', 'Просмотреть Заявку'), 'url' => [
        '/mail/mailOrderBackend/view',
        'id' => $model->id
    ]],
    ['icon' => 'fa fa-fw fa-trash-o', 'label' => Yii::t('MailModule.mail', 'Удалить Заявку'), 'url' => '#', 'linkOptions' => [
        'submit' => ['/mail/mailOrderBackend/delete', 'id' => $model->id],
        'confirm' => Yii::t('MailModule.mail', 'Вы уверены, что хотите удалить Заявку?'),
        'csrf' => true,
    ]],
];
?>
<div class="page-header">
    <h1>
        <?=  Yii::t('MailModule.mail', 'Просмотр') . ' ' . Yii::t('MailModule.mail', 'Заявки'); ?>        <br/>
        <small>&laquo;<?=  $model->name; ?>&raquo;</small>
    </h1>
</div>

<?php $this->widget('bootstrap.widgets.TbDetailView', [
    'data'       => $model,
    'attributes' => [
        'id',
        'theme',
        'name',
        'phone',
        'email',
        'comment',
        'data',
        'group',
        'status',
    ],
]); ?>
