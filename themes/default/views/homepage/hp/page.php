<?php
/** @var Page $page */

if ($page->layout) {
    $this->layout = "//layouts/{$page->layout}";
}

$this->title = $page->meta_title ?: $page->title;
$this->breadcrumbs = [
    Yii::t('HomepageModule.homepage', 'Pages'),
    $page->title
];
$this->description = !empty($page->meta_description) ? $page->meta_description : Yii::app()->getModule('yupe')->siteDescription;
$this->keywords = !empty($page->meta_keywords) ? $page->meta_keywords : Yii::app()->getModule('yupe')->siteKeyWords;

?>
<div class="home-section">
	<div class="slider-home">
		<?php $this->widget('application.modules.slider.widgets.SliderWidget', [
			'category_id' => 1
		]); ?>
	</div>

    <div class="comfortWithUs-content">
        <div class="comfortWithUs-section">
            <div class="comfortWithUs-section__header comfortWithUs-header">
                <div class="content fl fl-ju-co-sp-b">
                    <div class="comfortWithUs-header__heading h1Home-style">
                        <?= $page->getAttributeValue('box1')['name']; ?>
                    </div>
                    <div class="comfortWithUs-header__desc t-stl">
                        <?= $page->getAttributeValue('box1')['value']; ?>
                    </div>
                </div>
            </div>
            <div class="comfortWithUs-section__body">
                <div class="content">
                    <?php $this->widget('application.modules.gallery.widgets.CustomFieldWidget', [
                        'id' => $page->id,
                        'code' => 'box1',
                        'view' => 'comfortWithUs-home'
                    ]); ?>
                </div>
            </div>
        </div>
    </div>
    <div class="news-section">
        <div class="content">
            <div class="news-section__header news-header fl fl-al-it-c fl-ju-co-sp-b">
                <div class="news-header__heading h1Home-style">
                    Актуальные <br>Новости и события
                </div>
                <div class="news-header__but">
                    <a class="but-link but-link-svg but-link-svg-right fl fl-al-it-c" href="<?= Yii::app()->createUrl('/news/news/index'); ?>">
                        <span>Архив новостей</span>
                        <?= file_get_contents('.'. Yii::app()->getTheme()->getAssetsUrl() . '/images/icon/icon-arrow.svg'); ?>
                    </a>
                </div>
            </div>

            <?php $this->widget('application.modules.news.widgets.NewsHomeWidget', [
                'categories' => Yii::app()->getModule('news')->newsId,
                'itemView' => '_item-one',
                'limit' => 5
            ]); ?>
        </div>
    </div>

    <?php $this->widget('application.modules.gallery.widgets.CustomFieldWidget', [
        'id' => $page->id,
        'code' => 'instagram',
        'view' => 'instagram-subcribe'
    ]); ?>

    <?php $this->widget('application.modules.gallery.widgets.CustomFieldWidget', [
        'id' => $page->id,
        'code' => 'box3',
        'view' => 'video-home-box3'
    ]); ?>

    <div class="kinds-section fl fl-ju-co-c">
        <picture>
            <source media="(min-width: 1px)" srcset="<?= $page->geFieldImageWebp(0, 0, false,  $page->getAttributeValue('kinds')['image']); ?>" type="image/webp">
            <source media="(min-width: 1px)" srcset="<?= $page->getFieldImageUrl(0, 0, false,  $page->getAttributeValue('kinds')['image']); ?>">

            <img src="<?= $page->getFieldImageUrl(0, 0, false,  $page->getAttributeValue('kinds')['image']); ?>" alt="">
        </picture>
    </div>
</div>