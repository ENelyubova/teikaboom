<?php
/**
 * Отображение для ./themes/default/views/news/news/news.php:
 *
 * @category YupeView
 * @package  YupeCMS
 * @author   Yupe Team <team@yupe.ru>
 * @license  https://github.com/yupe/yupe/blob/master/LICENSE BSD
 * @link     https://yupe.ru
 *
 * @var $this NewsController
 * @var $model News
 **/
?>
<?php
$this->title = $model->meta_title ?: $model->title;
$this->description = $model->meta_description;
$this->keywords = $model->meta_keywords;

$this->breadcrumbs = [
    $model->category->name => ['/news/news/index'],
    strip_tags($model->title)
];

?>

<div class="page-header-main news-header-main">
    <div class="content">
        <?php $this->widget('application.components.MyTbBreadcrumbs', [
            'links' => $this->breadcrumbs,
        ]); ?>
        <div class="page-header-nav fl fl-wr-w fl-ju-co-sp-b">
            <a class="page-header-nav__back but-link but-link-white but-link-svg but-link-svg-left fl fl-al-it-c" href="<?= Yii::app()->request->urlReferrer ?: Yii::app()->createUrl('/news/news/index'); ?>">
                <?= file_get_contents('.'. Yii::app()->getTheme()->getAssetsUrl() . '/images/icon/icon-back.svg'); ?>
                <span>Назад</span>
            </a>
            <a class="page-header-nav__share but-link but-link-white but-link-svg but-link-svg-right fl fl-al-it-c" data-toggle="modal" data-target="#shareListModal" href="#">
                <span>Поделиться новостью</span>
                <?= file_get_contents('.'. Yii::app()->getTheme()->getAssetsUrl() . '/images/icon/icon-share.svg'); ?>
            </a>
        </div>
        <div class="news-header-data fl fl-wr-w fl-al-it-c">
            <div class="news-header-data__item news-park-badge fl fl-al-it-c" style="<?= ($model->park_id) ? 'background: '.$model->park->back : ''; ?>"><?= ($model->park_id) ? $model->park->name_short : 'Во всех парках'; ?></div>
            <div class="news-header-data__item fl fl-al-it-c"><?= $model->type_news; ?></div>
            <div class="news-header-data__item fl fl-al-it-c"><?= date("d.m.Y", strtotime($model->date)); ?></div>
        </div>
        <h1 class="color-white txt-up-none m-b-35"><?= CHtml::encode($model->title); ?></h1>
    </div>
</div>
    
<div class="page-content">
    <div class="content">
        <div class="news-view fl fl-wr-w fl-ju-co-sp-b">
            <div class="news-view__content news-view-content back-white-content">
                <div class="news-view-content__img">
                    <?php if ($model->image): ?>
                        <?= CHtml::image($model->getImageUrl(), $model->title, ['class' => 'img-responsive']); ?>
                    <?php endif; ?>
                </div>
                <div class="news-view-content__txt t-stl">
                    <?= $model->full_text; ?>
                </div>
            </div>
            <div class="news-view__sidebar news-view-sidebar">
                <?php $this->widget('application.modules.news.widgets.NewsWidget', [
                    'limit' => 3,
                    'notId' => $model->id,
                    'parkId' => $model->park_id,
                    'categories' => $model->category_id,
                    'view' => 'others-news-widget'
                ]); ?>
            </div>
        </div>
	</div>
</div>

<?php /* Модалка поделиться */?>
<?php $this->widget('application.modules.contentblock.widgets.ContentMyBlockWidget', ['view' => 'share-list']); ?>