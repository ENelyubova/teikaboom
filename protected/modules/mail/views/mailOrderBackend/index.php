<?php
/**
 * Отображение для index:
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
    Yii::t('MailModule.mail', 'Управление'),
];

$this->pageTitle = Yii::t('MailModule.mail', 'Заявки - управление');

$this->menu = [
    ['icon' => 'fa fa-fw fa-list-alt', 'label' => Yii::t('MailModule.mail', 'Управление Заявками'), 'url' => ['/mail/mailOrderBackend/index']],
    ['icon' => 'fa fa-fw fa-plus-square', 'label' => Yii::t('MailModule.mail', 'Добавить Заявку'), 'url' => ['/mail/mailOrderBackend/create']],
];
?>
<div class="page-header">
    <h1>
        <?=  Yii::t('MailModule.mail', 'Заявки'); ?>
        <small><?=  Yii::t('MailModule.mail', 'управление'); ?></small>
    </h1>
</div>

<p>
    <a class="btn btn-default btn-sm dropdown-toggle" data-toggle="collapse" data-target="#search-toggle">
        <i class="fa fa-search">&nbsp;</i>
        <?=  Yii::t('MailModule.mail', 'Поиск Заявок');?>
        <span class="caret">&nbsp;</span>
    </a>
</p>

<div id="search-toggle" class="collapse out search-form">
        <?php Yii::app()->clientScript->registerScript('search', "
        $('.search-form form').submit(function () {
            $.fn.yiiGridView.update('mail-order-grid', {
                data: $(this).serialize()
            });

            return false;
        });
    ");
    $this->renderPartial('_search', ['model' => $model]);
?>
</div>

<br/>

<p> <?=  Yii::t('MailModule.mail', 'В данном разделе представлены средства управления Заявками'); ?>
</p>

<?php
 $this->widget(
    'yupe\widgets\CustomGridView',
    [
        'id'           => 'mail-order-grid',
        'type'         => 'striped condensed',
        'hideBulkActions' => true,
        'dataProvider' => $model->search(),
        'filter'       => $model,
        'columns'      => [
            'id',
            'theme',
            'name',
            'phone',
            'email',
            'comment',
//            'data',
//            'group',
//            'status',
            [
                'class' => 'yupe\widgets\CustomButtonColumn',
                'template' => ''
                // 'template' => '{update}'
            ],
        ],
    ]
); ?>
