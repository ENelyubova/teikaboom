<?php $photos = $model->photos(['order' => 'position DESC']); ?>
<?php if($photos) : ?>
    <div class="parkView-carousel carousel-arrow-circle slick-slider">
        <?php foreach ($photos as $key => $data) : ?>
            <?php if($this->webp_support) : ?>
                <?php $originImage = $data->getImageUrlWebp(0, 0, true, null, 'image'); ?>
            <?php else : ?>
                <?php $originImage = $data->getImageNewUrl(0, 0, true, null, 'image'); ?>
            <?php endif; ?>
            <div class="parkView-carousel__item">
                <div class="parkView-carousel__img box-style-img">
                    <a class="parkView-carousel__link" data-fancybox="gallery-<?= $model->id; ?>" href="<?= $originImage; ?>">
                        <picture>
                            <source media="(min-width: 1601px)" srcset="<?= $data->getImageUrlWebp(538, 320, false, null, 'image'); ?>" type="image/webp">
                            <source media="(min-width: 1601px)" srcset="<?= $data->getImageNewUrl(538, 320, false, null, 'image'); ?>">
                            
                            <source media="(min-width: 1241px)" srcset="<?= $data->getImageUrlWebp(480, 285, false, null, 'image'); ?>" type="image/webp">
                            <source media="(min-width: 1241px)" srcset="<?= $data->getImageNewUrl(480, 285, false, null, 'image'); ?>">
                            
                            <source media="(min-width: 1001px)" srcset="<?= $data->getImageUrlWebp(400, 240, false, null, 'image'); ?>" type="image/webp">
                            <source media="(min-width: 1001px)" srcset="<?= $data->getImageNewUrl(400, 240, false, null, 'image'); ?>">

                            <source media="(min-width: 641px)" srcset="<?= $data->getImageUrlWebp(340, 200, false, null, 'image'); ?>" type="image/webp">
                            <source media="(min-width: 641px)" srcset="<?= $data->getImageNewUrl(340, 200, false, null, 'image'); ?>">
                            
                            <source media="(min-width: 1px)" srcset="<?= $data->getImageUrlWebp(270, 200, false, null, 'image'); ?>" type="image/webp">
                            <source media="(min-width: 1px)" srcset="<?= $data->getImageNewUrl(270, 200, false, null, 'image'); ?>">

                            <img src="<?= $data->getImageNewUrl(538, 320, false, null, 'image'); ?>" alt="">
                        </picture>
                    </a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    <?php $fancybox = $this->widget(
        'gallery.extensions.fancybox3.AlFancybox', [
            'target' => "[data-fancybox=gallery-{$model->id}]",
            'lang'   => 'ru',
            'config' => [
                'animationEffect' => "fade",
                'buttons' => [
                    "zoom",
                    "close",
                ]
            ],
        ]
    ); ?>
<?php endif; ?>