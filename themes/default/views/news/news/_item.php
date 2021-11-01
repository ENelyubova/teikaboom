<div class="news-box__item">
    <div class="news-box__img box-style-img">
        <div class="news-box__badge news-park-badge" style="<?= ($data->park_id) ? 'background: '.$data->park->back : ''; ?>"><?= ($data->park_id) ? $data->park->name_short : 'Во всех парках'; ?></div>
        <a href="<?= Yii::app()->createUrl('/news/news/view', ['slug' => $data->slug]); ?>">
            <picture>
                <source media="(min-width: 1px)" srcset="<?= $data->getImageUrlWebp(650, 529, true, null, 'image'); ?>" type="image/webp">
                <source media="(min-width: 1px)" srcset="<?= $data->getImageNewUrl(650, 529, true, null, 'image'); ?>">

                <img src="<?= $data->getImageNewUrl(650, 529, true, null, 'image'); ?>" alt="<?= $data->title; ?>">
            </picture>
        </a>
    </div>
    <div class="news-box__info fl fl-di-c fl-ju-co-sp-b">
        <div>
            <div class="news-box__type"><?= $data->type_news; ?></div>
            <div class="news-box__name">
                <a class="news-box__link" href="<?= Yii::app()->createUrl('/news/news/view', ['slug' => $data->slug]); ?>">
                    <?= $data->title; ?>
                </a>
            </div>
        </div>
        <div class="news-box__date"><?= date("d.m.Y", strtotime($data->date)); ?></div>
    </div>
</div>
