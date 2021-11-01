<?php
/**
 * Шаблон вывода страницы парка (Общая информация)
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

        <div class="parkView-info back-white-content fl fl-wr-w t-stl">
            <div class="parkView-info__item parkView-info__txt">
                <?= $modelPage->description; ?>
            </div>
            <div class="parkView-info__item parkView-info__contacts">
                <?= $modelPage->getAttributeValue('booking')['value']; ?>

                <div class=""></div>

                <?php /* // Выводится в произвольном поле, тут выведено, если там случайно, что удалят ?>  
                    <div class="parkView-data">
                        <div class="parkView-data__item">
                            <div class="parkView-data__header">Время бронирования:</div>
                            <div class="parkView-data__value booking-time-list">
                                <div class="booking-time-list__item">10:00 - 13:30</div>
                                <div class="booking-time-list__item">14.30 - 17.30</div>
                                <div class="booking-time-list__item">18:30 - 22:00</div>
                            </div>
                        </div>
                        <div class="parkView-data__item">
                            <div class="parkView-data__header">Условия бронирования</div>
                            <div class="parkView-data__value">
                                <p>Бронирование комнаты осуществляется по 100% предоплате не позднее, чем за 10 дней до праздника.</p>
                            </div>
                            <div class="parkView-booking-table">
                                <div class="parkView-booking-table__row parkView-booking-table__row_head">
                                    <div class="parkView-booking-table__col">
                                        <div class="parkView-data__value">Будни</div>
                                        <div class="days-list fl">
                                            <div class="days-list__item">Пн</div>
                                            <div class="days-list__item">Вт</div>
                                            <div class="days-list__item">Ср</div>
                                            <div class="days-list__item">Чт</div>
                                            <div class="days-list__item">Пт</div>
                                        </div>
                                    </div>
                                    <div class="parkView-booking-table__col">
                                        <div class="parkView-data__value">Выходные и праздничные дни</div>
                                        <div class="days-list fl">
                                            <div class="days-list__item days-list__item_weekend">Сб</div>
                                            <div class="days-list__item days-list__item_weekend">Вс</div>
                                            <div class="days-list__item days-list__item_weekend days-list__item_star"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="parkView-booking-table__row">
                                    <div class="parkView-booking-table__col">
                                        <div class="parkView-data__header">Цена за 1 ребенка</div>
                                        <div class="parkView-data__value color-pink">650 руб.</div>
                                    </div>
                                    <div class="parkView-booking-table__col">
                                        <div class="parkView-data__header">Цена за 1 ребенка</div>
                                        <div class="parkView-data__value color-pink">1390 руб.</div>
                                    </div>
                                </div>
                                <div class="parkView-booking-table__row">
                                    <div class="parkView-booking-table__col">
                                        <div class="parkView-data__header">Взрослые</div>
                                        <div class="parkView-data__value">Бесплатно</div>
                                    </div>
                                    <div class="parkView-booking-table__col">
                                        <div class="parkView-data__header">Взрослые</div>
                                        <div class="parkView-data__value">Бесплатно</div>
                                    </div>
                                </div>
                            </div>
                            <div class="parkView-booking-but fl fl-wr-w fl-al-it-c">
                                <div class="parkView-booking-but__button">
                                    <a class="but but-pink but-animation" data-toggle="modal" data-target="#bookingBanquetRoomModal" href="#">Бронировать</a>
                                </div>
                                <div class="parkView-booking-but__terms color-grey txt-style">
                                    Минимальное количество оплачиваемых билетов <br>при бронировании банкетных комнат от 8 шт.
                                </div>
                            </div>
                        </div>
                        <div class="parkView-data__item parkView-data__item_terms">
                            <div class="color-grey txt-style">
                                Возможно указание каких-либо дополнительных параметров в правом столбце, это может быть или мелкий текст, как этот, или же формат подобный пункту “Время бронирования или “Условия бронирования”. 
                            </div>
                        </div>
                    </div>
                <?php */ ?>
            </div>
        </div>
    </div>
</div>

<?php /* Бронирование банкетной комнаты */?>
<?php $this->widget('application.modules.mail.widgets.GeneralFeedbackWidget', [
    'id' => 'bookingBanquetRoomModal',
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
        'theme' => "Бронирование банкетной комнаты в парке {$modelPark->name_short}",
    ],
]) ?>