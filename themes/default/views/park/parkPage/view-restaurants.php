<?php
/**
 * Шаблон вывода страницы парка (Рестораны)
 *
 * @var $this ParkPageController
 * @var $model ParkPage
 **/


$this->title = $modelPage->meta_title ?: $modelPage->name;
// $this->breadcrumbs = $this->getBreadCrumbs();
$this->description = $modelPage->meta_description ?: Yii::app()->getModule('yupe')->siteDescription;
$this->keywords = $modelPage->meta_keywords ?: Yii::app()->getModule('yupe')->siteKeyWords;
?>

<?php // Шапка для парка и навигация ?>
<?php $this->renderPartial('//park/park/_view-header', ['model' => $modelPark]); ?>

<div class="page-content parkView-content">
    <div class="content">
        <?php // Галерея ?>
        <?php $this->renderPartial('//park/park/_view-gallery', ['model' => $modelPage]); ?>
        
        <div class="back-white-content">
            <div class="parkView-info fl fl-wr-w t-stl">
                <div class="parkView-info__item parkView-info__txt">
                    <?= $modelPage->description; ?>
                </div>
                <div class="parkView-info__item parkView-info__contacts">
                    <?= $modelPage->getAttributeValue('restaurants')['value']; ?>
                </div>
            </div>

            <?php $childrenPage = $modelPage->children(['order' => 'position ASC']); ?>
            <?php if($childrenPage) : ?>
                <div class="parkView-childpage-list parkView-restaurannts-list">
                    <?php foreach ($childrenPage as $key => $data) : ?>
                        <div class="parkView-childpage-list__item childpage-list fl fl-wr-w fl-ju-co-sp-b">
                            <div class="childpage-list__content fl fl-di-c fl-ju-co-sp-b">
                                <div>
                                    <div class="childpage-list__name"><?= $data->name; ?></div>
                                    <div class="childpage-list__desc t-stl"><?= $data->description_short; ?></div>
                                </div>
                            </div>
                            <div class="childpage-list__carousel">
                                <?php $photos = $data->photos(['order' => 'position DESC']); ?>
                                <?php if($photos) : ?>
                                    <div class="parkView-childpage-carousel parkView-restaurannts-carousel slick-slider">
                                        <?php foreach ($photos as $key => $data) : ?>
                                            <?php if($this->webp_support) : ?>
                                                <?php $originImage = $data->getImageUrlWebp(0, 0, true, null, 'image'); ?>
                                            <?php else : ?>
                                                <?php $originImage = $data->getImageNewUrl(0, 0, true, null, 'image'); ?>
                                            <?php endif; ?>
                                            <div class="parkView-childpage-carousel__item">
                                                <div class="parkView-childpage-carousel__img box-style-img">
                                                    <a class="parkView-childpage-carousel__link"data-fancybox="gallery-<?= $modelPage->id; ?>-<?= $data->id; ?>" href="<?= $originImage; ?>">
                                                        <picture>
                                                            <source media="(min-width: 1px)" srcset="<?= $data->getImageUrlWebp(538, 320, false, null, 'image'); ?>" type="image/webp">
                                                            <source media="(min-width: 1px)" srcset="<?= $data->getImageNewUrl(538, 320, false, null, 'image'); ?>">

                                                            <img src="<?= $data->getImageNewUrl(538, 320, false, null, 'image'); ?>" alt="">
                                                        </picture>
                                                    </a>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                    <?php $fancybox = $this->widget(
                                        'gallery.extensions.fancybox3.AlFancybox', [
                                            'target' => "[data-fancybox=gallery-{$modelPage->id}-{$data->id}]",
                                            'lang'   => 'ru',
                                            'config' => [
                                                'animationEffect' => "fade",
                                                'buttons' => [
                                                    "zoom",
                                                    "close",
                                                ],
                                                // 'backFocus' => false,
                                                // 'autoFocus' => false,
                                            ],
                                        ]
                                    ); ?>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php /* Блок остались вопросы */?>
<?php $this->widget('application.modules.contentblock.widgets.ContentMyBlockWidget', [
    'id' => 1,
    'view' => 'stillQuestions-box'
]); ?>

<?php /* Бронирование столика */?>
<?php $this->widget('application.modules.mail.widgets.GeneralFeedbackWidget', [
    'id' => 'bookingStolRestaurantsModal',
    'formClassName' => 'StandartForm',
    'buttonModal' => false,
    'titleModal' => 'Бронирование',
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
        'theme' => "Бронирование столика в парке {$modelPark->name_short}",
    ],
]) ?>