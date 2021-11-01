<?php $photos = $model->getAttributeValue($code)['gallery']; ?>
<?php if($photos) : ?>
	<div class="comfortWithUs-box fl fl-ju-co-sp-b">
        <div class="comfortWithUs-box__nav comfortWithUs-nav">
            <?php foreach ($photos as $key => $photo): ?>
                <div class="comfortWithUs-nav__item fl fl-al-it-c">
                    <a class="comfortWithUs-nav__link <?= ($key == 0) ? 'active' : ''; ?>" style="<?= ($photo['color']) ? 'color: '.$photo['color'] : ''; ?>" data-toggle="tab" href="#comfortWithUs-media-<?= $key; ?>">
                        <?= $photo['title']; ?>
                        <span class="comfortWithUs-nav__underline" style="<?= ($photo['color']) ? 'background: '.$photo['color'] : ''; ?>"></span>        
                    </a>
                </div>
            <?php endforeach ?>
        </div>
        <div class="comfortWithUs-box__media tab-content comfortWithUs-media">
            <?php foreach ($photos as $key => $photo): ?>
                <div class="tab-pane comfortWithUs-media__item <?= ($key == 0) ? 'active' : ''; ?>" id="comfortWithUs-media-<?= $key; ?>">
                    <div class="comfortWithUs-media__name" style="<?= ($photo['color']) ? 'color: '.$photo['color'] : ''; ?>"><?= $photo['title']; ?></div>
                    <div class="comfortWithUs-media__img" data-aos="zoom-in" data-aos-once="true">
                        <picture>
                            <source media="(min-width: 1px)" srcset="<?= $model->geFieldGalImageWebp(0, 0, false,  $photo['image']); ?>" type="image/webp">
                            <source media="(min-width: 1px)" srcset="<?= $model->getFieldGalImageUrl(0, 0, false,  $photo['image']); ?>">

                            <img src="<?= $model->getFieldGalImageUrl(0, 0, false,  $photo['image']); ?>" alt="<?= $photo['title']; ?>">
                        </picture>
                        <span class="comfortWithUs-media__imgH"><?= $photo['alt']; ?></span>
                    </div>
                </div>
            <?php endforeach ?>
        </div>
    </div>
    <?php Yii::app()->getClientScript()->registerScript("js-tab-update", "
        $('[data-toggle=\"tab\"]').on('shown.bs.tab', function (e) {
            var pane = $(e.target).attr('href');
            $(pane).find('.comfortWithUs-media__img').removeClass('aos-init aos-animate');
            AOS.refresh();
        });
    "); ?>
<?php endif; ?>