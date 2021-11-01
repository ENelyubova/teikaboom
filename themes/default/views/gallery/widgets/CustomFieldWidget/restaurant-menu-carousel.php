<?php $photos = $model->getAttributeValue($code)['gallery']; ?>
<?php if($photos) : ?>
    <?php foreach ($photos as $key => $photo): ?>
        <div class="restaurantView-carousel__item">
            <?php if($fancybox) : ?>
                <a class="restaurantView-carousel__link fl fl-al-it-c fl-ju-co-c" data-fancybox="image" href="<?= $model->getFieldGalImageUrl(0, 0, false,  $photo['image']); ?>">
            <?php endif; ?>
                <picture class="absolute-img">
                    <source media="(min-width: 401px)" srcset="<?= $model->geFieldGalImageWebp(0, 0, false,  $photo['image']); ?>" type="image/webp">
                    <source media="(min-width: 401px)" srcset="<?= $model->getFieldGalImageUrl(0, 0, false,  $photo['image']); ?>">

                    <source media="(min-width: 1px)" srcset="<?= $model->geFieldGalImageWebp(320, 175, true,  $photo['image']); ?>" type="image/webp">
                    <source media="(min-width: 1px)" srcset="<?= $model->getFieldGalImageUrl(320, 175, true,  $photo['image']); ?>">

                    <img src="<?= $model->getFieldGalImageUrl(0, 0, false,  $photo['image']); ?>" alt="<?= $data->title; ?>">
                </picture>
            <?php if($fancybox) : ?>
                </a>
            <?php endif; ?>
        </div>
    <?php endforeach ?>
<?php endif; ?>