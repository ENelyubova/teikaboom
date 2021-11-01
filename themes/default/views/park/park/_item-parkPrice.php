<?php $url = Yii::app()->createUrl('/park/park/view', ['slug' => $data->slug]); ?>

<div class="park-list__item fl fl-ju-co-sp-b <?= $data->class; ?>">
    <div class="park-list__content fl fl-di-c fl-ju-co-sp-b">
        <div>
            <a href="<?= $url; ?>">
                <div class="park-list__name park-name"><?= $data->name; ?></div>
            </a>
            <?php if($data->subway_station) :?>
                <div class="park-list__station park-station park-station-inline park-station-white"><?= $data->subway_station; ?></div>
            <?php endif; ?>
            <?php if($data->address) :?>
                <div class="park-list__location txt-style"><?= $data->address; ?></div>
            <?php endif; ?>
            <?php if($data->count_room) :?>
                <div class="park-list__desc t-stl"><?= $data->count_room; ?> для мероприятий</div>
            <?php endif; ?>
        </div>
    </div>
    <div class="park-list__img">
        <a href="<?= $url; ?>">
            <picture>
                <source media="(min-width: 1px)" srcset="<?= $data->getImageUrlWebp(0, 0, false, null, 'image'); ?>" type="image/webp">
                <source media="(min-width: 1px)" srcset="<?= $data->getImageNewUrl(0, 0, false, null, 'image'); ?>">

                <img src="<?= $data->getImageNewUrl(0, 0, false, null, 'image'); ?>" alt="">
            </picture>
        </a>
    </div>
</div>