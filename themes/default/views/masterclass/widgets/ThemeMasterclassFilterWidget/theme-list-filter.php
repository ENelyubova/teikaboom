<div class="parkView-nav parkView-nav-carousel slick-slider themeFilter-nav mcs-horizontal">
    <div class="parkView-nav__item jsfilter-theme-item">
        <a class="parkView-nav__link fl fl-al-it-c jsfilter-theme-masterclass <?= !isset($_GET['theme_id']) ? 'active': ''; ?>" data-id="0" href="#">
            <picture>
                <source media="(min-width: 1px)" srcset="<?= Yii::app()->getTheme()->getAssetsUrl() . '/images/masterclass/all.webp'; ?>" type="image/webp">
                <source media="(min-width: 1px)" srcset="<?= Yii::app()->getTheme()->getAssetsUrl() . '/images/masterclass/all.png'; ?>">
                
                <img src="<?= Yii::app()->getTheme()->getAssetsUrl() . '/images/masterclass/all.png'; ?>" alt="">
            </picture>
            <span>Все мастер классы</span>
        </a>
    </div>
    <?php foreach($model as $data):?>
        <?php print_r(Yii::app()->themeFilter->isMainSearchParamChecked('theme', $data->id, Yii::app()->getRequest())); ?>
        <div class="parkView-nav__item jsfilter-theme-item">
            <a class="parkView-nav__link fl fl-al-it-c jsfilter-theme-masterclass <?= (isset($_GET['theme_id']) &&  $_GET['theme_id'] == $data->id) ? 'active': ''; ?>" data-id="<?= $data->id; ?>" href="#">
                <picture>
                    <source media="(min-width: 1px)" srcset="<?= $data->getImageUrlWebp(0, 0, true, null, 'image'); ?>" type="image/webp">
                    <source media="(min-width: 1px)" srcset="<?= $data->getImageNewUrl(0, 0, true, null, 'image'); ?>">

                    <img src="<?= $data->getImageNewUrl(0, 0, true, null, 'image'); ?>" alt="">
                </picture>
                <span><?= $data->name_short; ?></span>
            </a>
        </div>
    <?php endforeach;?>
</div>