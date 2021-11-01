<?php
$this->title = $category->meta_title ?: $category->name;
$this->description = $category->meta_description;
$this->keywords = $category->meta_keywords;

$this->breadcrumbs = [
    strip_tags($category->name)
];
?>

<?php if($this->webp_support) : ?>
    <?php $backHeader = $category->getImageUrlWebp(0, 0, true, null, 'image'); ?>
<?php else : ?>
    <?php $backHeader = $category->getImageNewUrl(0, 0, true, null, 'image'); ?>
<?php endif; ?>

<div class="page-header-main news-header-main" style="<?= $category->image ? 'background: url('.$backHeader.') no-repeat;': ''?>">
    <div class="content">
        <?php $this->widget('application.components.MyTbBreadcrumbs', [
            'links' => $this->breadcrumbs,
        ]); ?>
        <h1 class="color-white"><?= $category->getTitle(); ?></h1>
        
        <form id="news-filter" name="news-filter" method="get" action="<?= Yii::app()->createUrl('/news/news/index'); ?>">
            <?php $this->widget('application.modules.park.widgets.filters.ParkFilterListNews'); ?>
        </form>
    </div>
</div>
    
<div class="page-content">
    <div class="content">
		<?php  $this->widget(
            'application.components.FtListView',
            [
                'dataProvider' => $dataProvider,
                'id' => 'news-box',
                'itemView' => $itemView,
                'template'=>'
                    {items}
                    {pager}
                ',
                'itemsCssClass' => "news-box",
                'htmlOptions' => [
                    'class' => 'news-box-listView'
                ],
                'ajaxUpdate'=>true,
                'enableHistory' => true,
                'pagerCssClass' => 'pagination-box',
                'pager' => [
                    'class' => 'application.components.ShowMorePager',
                    'buttonText' => 'Показать еще',
                    'isNews' => true,
                    'wrapTag' => 'div',
                    'htmlOptions' => [
                        'class' => 'but-link but-link-svg but-link-svg-right fl fl-al-it-c'
                    ],
                    'wrapOptions' => [
                        'class' => ''
                    ],
                ]
            ]
        ); ?>
	</div>
</div>
    
<?php $this->widget('application.modules.gallery.widgets.CustomFieldWidget', [
    'id' => Yii::app()->getModule('homepage')->target,
    'code' => 'instagram',
    'view' => 'instagram-subcribe'
]); ?>

