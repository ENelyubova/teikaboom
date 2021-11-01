<?php
/**
 * Шаблон вывода страницы парка (Общая информация)
 *
 * @var $this ParkPageController
 * @var $model ParkPage
 **/

$this->title = $model->meta_title ?: $model->name;
// $this->breadcrumbs = $this->getBreadCrumbs();
$this->description = $model->meta_description ?: Yii::app()->getModule('yupe')->siteDescription;
$this->keywords = $model->meta_keywords ?: Yii::app()->getModule('yupe')->siteKeyWords;
?>

<?php // Шапка для парка и навигация ?>
<?php $this->renderPartial('_view-header', ['model' => $model]); ?>

<div class="page-content parkView-content">
    <div class="content">
    <?php // Галерея ?>
    <?php $this->renderPartial('_view-gallery', ['model' => $model]); ?>

        <div class="parkView-info back-white-content fl fl-wr-w t-stl">
            <div class="parkView-info__item parkView-info__txt">
                <?= $model->description; ?>
            </div>
            <div class="parkView-info__item parkView-info__contacts">
                <div class="parkView-data">
                    <div class="parkView-data__item">
                        <div class="parkView-data__header">Парк TeikaBoom</div>
                        <div class="parkView-data__value"><?= $model->name_short; ?></div>
                    </div>
                    <div class="parkView-data__item">
                        <div class="parkView-data__header">Адрес торгово-развлекательного центра</div>
                        <div class="parkView-data__value parkView-contact-location"><?= $model->address; ?></div>
                        <?php if($model->map_code) : ?>
                            <div class="parkView-collapse js-collapse active">
                                <div class="parkView-collapse__header">
                                    <a class="but-link but-link-svg but-link-svg-right fl fl-al-it-c js-collapse-header" href="#">
                                        <span>Показать на карте</span>
                                        <?= file_get_contents('.'. Yii::app()->getTheme()->getAssetsUrl() . '/images/icon/icon-up.svg'); ?>
                                    </a>
                                </div>
                                <div class="parkView-collapse__body js-collapse-body" style="display: block;">
                                    <iframe class="parkView-contact-map" src="<?= $model->map_code; ?>" frameborder="0"></iframe>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="parkView-data__item">
                        <div class="parkView-data__header">Станция метро</div>
                        <div class="parkView-data__value park-station park-station-inline"><?= $model->subway_station; ?></div>
                        <?php if($model->how_to_get) : ?>
                            <div class="parkView-collapse js-collapse">
                                <div class="parkView-collapse__header">
                                    <a class="but-link but-link-svg but-link-svg-right fl fl-al-it-c js-collapse-header" href="#">
                                        <span>Как добраться</span>
                                        <?= file_get_contents('.'. Yii::app()->getTheme()->getAssetsUrl() . '/images/icon/icon-up.svg'); ?>
                                    </a>
                                </div>
                                <div class="parkView-collapse__body js-collapse-body" style="display: none;">
                                    <div class="parkView-contact-howToGet park-station">
                                        <?= $model->how_to_get; ?>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="parkView-data__item">
                        <div class="parkView-data__header">Контактный телефон</div>
                        <div class="parkView-data__value parkView-contact-phone parkView-data-link"><?= $model->phone; ?></div>
                    </div>
                    <div class="parkView-data__item">
                        <div class="parkView-data__header">Режим работы</div>
                        <div class="parkView-data__value parkView-contact-mode"><?= $model->mode; ?></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>