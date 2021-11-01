<div class="parkView-header-main <?= $model->class; ?> fl">
	<div class="content">
        <div class="parkView-header-main__nav">
            <div class="page-header-nav fl fl-wr-w fl-ju-co-sp-b">
                <a class="page-header-nav__back but-link but-link-white but-link-svg but-link-svg-left fl fl-al-it-c" href="<?= Yii::app()->createUrl('/page/page/view', ['slug' => Yii::app()->getModule('park')->pageSlug]); ?>">
                    <?= file_get_contents('.'. Yii::app()->getTheme()->getAssetsUrl() . '/images/icon/icon-back.svg'); ?>
                    <span>Назад</span>
                </a>
                <a class="page-header-nav__share but-link but-link-white but-link-svg but-link-svg-right fl fl-al-it-c" data-toggle="modal" data-target="#shareListModal" href="#">
                    <span>Поделиться</span>
                    <?= file_get_contents('.'. Yii::app()->getTheme()->getAssetsUrl() . '/images/icon/icon-share.svg'); ?>
                </a>
            </div>
        </div>
        <div class="parkView-header-main__info">
			<div class="parkView-header-main__name h1Home-style color-white"><?= $model->getTitle(); ?></div>
			<div class="parkView-header-main__desc color-white">
                <?php if($model->subway_station) :?>
                    <div class="parkView-header-main__station park-station park-station-inline park-station-white"><?= $model->subway_station; ?></div>
                <?php endif; ?>
                <?php if($model->address) :?>
                    <div class="parkView-header-main__location txt-style color-white"><?= $model->address; ?></div>
                <?php endif; ?>
			</div>
		</div>
		<div class="parkView-header-main__img">
			<picture>
				<source media="(min-width: 1px)" srcset="<?= $model->getImageUrlWebp(0, 0, true, null, 'image'); ?>" type="image/webp">
				<source media="(min-width: 1px)" srcset="<?= $model->getImageNewUrl(0, 0, true, null, 'image'); ?>">
				
				<img src="<?= $model->getImageNewUrl(0, 0, true, null, 'image'); ?>" alt="">
			</picture>
		</div>
	</div>
</div>

<div class="content">
    <div class="parkView-nav parkView-nav-carousel slick-slider">
        <div class="parkView-nav__item">
            <a class="parkView-nav__link fl fl-al-it-c" href="<?= Yii::app()->createUrl('/park/park/view', ['slug' => $model->slug])?>">
                <picture>
                    <source media="(min-width: 1px)" srcset="<?= Yii::app()->getTheme()->getAssetsUrl() . '/images/park/info.webp'; ?>" type="image/webp">
                    <source media="(min-width: 1px)" srcset="<?= Yii::app()->getTheme()->getAssetsUrl() . '/images/park/info.png'; ?>">
                    
                    <img src="<?= Yii::app()->getTheme()->getAssetsUrl() . '/images/park/info.png'; ?>" alt="">
                </picture>
                <span>Общая информация</span>
            </a>
        </div>
        <?php $pages = $model->pagesRoot(['order' => 'position ASC']); ?>
        <?php if($pages) : ?>
            <?php foreach ($pages as $key => $data) : ?>
                <div class="parkView-nav__item">
                    <a class="parkView-nav__link fl fl-al-it-c" href="<?= Yii::app()->createUrl('/park/parkPage/view', ['slugPark' => $model->slug, 'slug' => $data->slug])?>">
                        <picture>
                            <source media="(min-width: 1px)" srcset="<?= $data->getImageUrlWebp(0, 0, true, null, 'image'); ?>" type="image/webp">
                            <source media="(min-width: 1px)" srcset="<?= $data->getImageNewUrl(0, 0, true, null, 'image'); ?>">

                            <img src="<?= $data->getImageNewUrl(0, 0, true, null, 'image'); ?>" alt="">
                        </picture>
                        <span><?= $data->name_short; ?></span>
                    </a>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>

<?php /* Модалка поделиться */?>
<?php $this->widget('application.modules.contentblock.widgets.ContentMyBlockWidget', ['view' => 'share-list']); ?>