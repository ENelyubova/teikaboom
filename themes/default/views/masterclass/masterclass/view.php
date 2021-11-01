<?php
/**
 * Отображение для ./themes/default/views/masterclass/masterclass/view.php:
 *
 * @category YupeView
 * @package  YupeCMS
 * @author   Yupe Team <team@yupe.ru>
 * @license  https://github.com/yupe/yupe/blob/master/LICENSE BSD
 * @link     https://yupe.ru
 *
 * @var $this MasterclassController
 * @var $model Masterclass
 **/
?>
<?php
$this->title = $model->meta_title ?: $model->name;
$this->description = $model->meta_description;
$this->keywords = $model->meta_keywords;

$this->breadcrumbs = [
    $modelPage->title => ['/masterclass/masterclass/index'],
    strip_tags($model->name)
];

?>

<?php if($this->webp_support) : ?>
    <?php $backHeader = $modelPage->getImageUrlWebp(0, 0, true, null, 'image'); ?>
<?php else : ?>
    <?php $backHeader = $modelPage->getImageNewUrl(0, 0, true, null, 'image'); ?>
<?php endif; ?>

<div class="page-header-main news-header-main" style="<?= $modelPage->image ? 'background: url('.$backHeader.') no-repeat;': ''?>">
    <div class="content">
        <?php $this->widget('application.components.MyTbBreadcrumbs', [
            'links' => $this->breadcrumbs,
        ]); ?>
        <div class="page-header-nav fl fl-wr-w fl-ju-co-sp-b">
            <a class="page-header-nav__back but-link but-link-white but-link-svg but-link-svg-left fl fl-al-it-c" href="<?= Yii::app()->request->urlReferrer ?: Yii::app()->createUrl('/masterclass/masterclass/index'); ?>">
                <?= file_get_contents('.'. Yii::app()->getTheme()->getAssetsUrl() . '/images/icon/icon-back.svg'); ?>
                <span>Назад</span>
            </a>
            <a class="page-header-nav__share but-link but-link-white but-link-svg but-link-svg-right fl fl-al-it-c" data-toggle="modal" data-target="#shareListModal" href="#">
                <span>Поделиться</span>
                <?= file_get_contents('.'. Yii::app()->getTheme()->getAssetsUrl() . '/images/icon/icon-share.svg'); ?>
            </a>
        </div>
        <div class="news-header-data fl fl-wr-w fl-al-it-c">
            <div class="news-header-data__item fl fl-al-it-c"><?= $model->theme->name_short; ?></div>
            <div class="news-header-data__item fl fl-al-it-c"><?= date("d.m.Y", strtotime($model->date)); ?></div>
            <div class="news-header-data__item fl fl-al-it-c txt-up-none"><?= ($model->park_id) ? $model->park->name_short : 'Во всех парках'; ?></div>
        </div>
        <h1 class="color-white txt-up-none m-b-35"><?= $model->getTitle(); ?></h1>
    </div>
</div>
    
<div class="page-content page-content-masterclass">
    <div class="content">
        <?php // Галерея ?>
        <?php $this->renderPartial('//park/park/_view-gallery', ['model' => $model]); ?>
        
        <div class="back-white-content">
            <div class="parkView-info masterclassView-info fl fl-wr-w t-stl">
                <div class="parkView-info__item parkView-info__txt">
                    <div class="parkView-data masterclassView-characteristics">
                        <?php if($model->duration) : ?>
                            <div class="parkView-data__item masterclassView-characteristics__item">
                                <div class="parkView-data__header">Продолжительность мастер-класса</div>
                                <div class="parkView-data__value"><?= $model->duration; ?></div>
                            </div>
                        <?php endif; ?>
                        <?php if($model->price) : ?>
                            <div class="parkView-data__item masterclassView-characteristics__item masterclassView-characteristics__item_price">
                                <div class="parkView-data__header">Стоимость для ребенка</div>
                                <div class="parkView-data__value fl fl-al-it-c"><?= round($model->price, 2); ?> <i class="icon icon-ruble"></i></div>
                            </div>
                        <?php endif; ?>
                        <?php if($model->age) : ?>
                            <div class="parkView-data__item masterclassView-characteristics__item">
                                <div class="parkView-data__header">Возрастная категория</div>
                                <div class="parkView-data__value"><?= $model->age; ?></div>
                            </div>
                        <?php endif; ?>
                        <div class="parkView-data__item masterclassView-characteristics__item masterclassView-characteristics__item_but">
                            <div class="fl">
                                <a class="but but-pink but-animation" data-toggle="modal" data-target="#signUpForMasterclassModal" href="#"><span>Записаться на мастер-класс</span></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="parkView-info__item parkView-info__contacts news-view-content">
                    <?= $model->description; ?>
                </div>
            </div>
        </div>
	</div>
    <?php /* Другие мастер классы */?>
    <?php $this->widget('application.modules.masterclass.widgets.OtherMasterclassWidget', [
        'notId' => $model->id,
        'parkId' => $model->park_id,
    ]); ?>
</div>

<?php /* Блок Календарь мастер-классов и мероприятий */?>
<?php $this->widget('application.modules.contentblock.widgets.ContentMyBlockWidget', [
    'id' => 3,
    'view' => 'stillQuestions-box-masterclass'
]); ?>

<?php /* Модалка поделиться */?>
<?php $this->widget('application.modules.contentblock.widgets.ContentMyBlockWidget', ['view' => 'share-list']); ?>

<?php /* Записаться на мастер класс */?>
<?php $this->widget('application.modules.mail.widgets.GeneralFeedbackWidget', [
    'id' => 'signUpForMasterclassModal',
    'formClassName' => 'StandartForm',
    'buttonModal' => false,
    'titleModal' => 'Записаться',
    'showCloseButton' => false,
    'isRefresh' => true,
    'eventCode' => 'zakazat-zvonok',
    'successKey' => 'zakazat-zvonok',
    'modalHtmlOptions' => [
        'class' => 'modal-my',
    ],
    'formOptions' => [
        'htmlOptions' => [
            'class' => 'form-my',
        ]
    ],
    'modelAttributes' => [
        'theme' => "Записаться на мастер класс {$model->name_short}",
    ],
]) ?>