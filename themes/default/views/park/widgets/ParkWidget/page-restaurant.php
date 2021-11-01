<?php if ($dataProvider->itemCount): ?>
    <div class="contact-box">
        <?php foreach ($dataProvider->getData() as $key => $data) : ?>
            <div class="contact-box__item fl fl-wr-w">
                <div class="contact-box__desc">
                    <?= $data->name_short; ?>
                    <?php if($data->docs) :?>
                        <div class="contact-box__btn">
                            <a href="<?= $data->getDocumentUrl(); ?>" class="but but-pink but-animation" target="_blank">Скачать меню</a>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="contact-box__info">
                    <div class="contact-box-data contact-box-data-park">
                        <div class="contact-box-data__header">Адрес</div>
                        <div class="contact-box-data__value">
                            <?= $data->address; ?>
                            <?php if($data->subway_station) :?>
                                <div class="park-station park-station-inline park-station-contactPage"><?= $data->subway_station; ?></div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="contact-box-data contact-box-data-park">
                        <div class="contact-box-data__header">Телефон</div>
                        <div class="contact-box-data__value">
                            <?= $data->phone; ?>
                        </div>
                    </div>
                    <div class="contact-box-data contact-box-data-park">
                        <div class="contact-box-data__header">Режим работы</div>
                        <div class="contact-box-data__value">
                            <?= $data->mode; ?>
                        </div>
                    </div>
                    <div class="contact-box-data contact-box-data-park">
                        <div class="contact-box-data__header">Кухня</div>
                        <div class="contact-box-data__value">
                            <?= $data->kitchen; ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>