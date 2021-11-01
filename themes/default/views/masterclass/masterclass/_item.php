<div class="news-box__item">
    <div class="news-box__img box-style-img">
        <a href="<?= Yii::app()->createUrl('/masterclass/masterclass/view', ['slug' => $data->slug]); ?>">
            <picture>
                <source media="(min-width: 1px)" srcset="<?= $data->getImageUrlWebp(650, 529, true, null, 'image'); ?>" type="image/webp">
                <source media="(min-width: 1px)" srcset="<?= $data->getImageNewUrl(650, 529, true, null, 'image'); ?>">

                <img src="<?= $data->getImageNewUrl(650, 529, true, null, 'image'); ?>" alt="">
            </picture>
        </a>
    </div>
    <div class="news-box__info fl fl-di-c fl-ju-co-sp-b">
        <div>
            <div class="news-box__type"><?= $data->theme->name_short; ?></div>
            <div class="news-box__name">
                <a class="news-box__link" href="<?= Yii::app()->createUrl('/masterclass/masterclass/view', ['slug' => $data->slug]); ?>">
                    <?= $data->name_short; ?>
                </a>
            </div>
        </div>
        <div class="news-box__bot">
            <div class="news-box-characteristics fl fl-wr-w fl-al-it-c">
                <div class="news-box-characteristics__item news-box-characteristics__price fl fl-al-it-c"><?= round($data->price, 2); ?><i class="icon icon-ruble"></i></div>
                <div class="news-box-characteristics__item news-box-characteristics__duration"><?= $data->duration; ?></div>
                <div class="news-box-characteristics__item news-box-characteristics__age"><?= $data->age; ?></div>
            </div>
            <div class="news-box__but fl fl-wr-w">
                <a class="but-link" href="<?= Yii::app()->createUrl('/masterclass/masterclass/view', ['slug' => $data->slug]); ?>"><span>Подробнее</span></a>
                <a class="but-link" href="#"><span>Ближайшее время проведения</span></a>
            </div>
        </div>
    </div>
</div>
