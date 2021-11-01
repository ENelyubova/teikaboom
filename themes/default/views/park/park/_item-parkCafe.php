<?php $url = Yii::app()->createUrl('/park/park/view', ['slug' => $data->slug]); ?>
<?php $photos = $data->photos(['order' => 'position DESC']); ?>

<div class="park-block__item fl fl-al-it-fl-e">
    <a href="<?= $url; ?>">
        <div class="park-block__name park-name"><?= $data->name; ?></div>
        <div class="park-block__img">
            <?php foreach ($photos as $key => $photo) : ?>
                <?php if ($key >= 0 && $key < 1) : ?>
                    <picture>
                        <source media="(min-width: 401px)" srcset="<?= $photo->getImageUrlWebp(0, 0, true, null,'image'); ?>" type="image/webp">
                        <source media="(min-width: 401px)" srcset="<?= $photo->getImageNewUrl(0, 0, true, null,'image'); ?>">

                        <source media="(min-width: 1px)" srcset="<?= $photo->getImageUrlWebp(270, 200, false, null, 'image'); ?>" type="image/webp">
                        <source media="(min-width: 1px)" srcset="<?= $photo->getImageNewUrl(270, 200, false, null, 'image'); ?>">

                        <img src="<?= $photo->getImageNewUrl(620, 340, false, null, 'image'); ?>" alt="">
                    </picture>
                <?php endif; ?>
            <?php endforeach; ?>
            <div class="park-block__shadow"></div>
        </div>
    </a>
</div>