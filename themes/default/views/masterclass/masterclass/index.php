<?php
$this->title = $model->meta_title ?: $model->title;
$this->description = $model->meta_description;
$this->keywords = $model->meta_keywords;

$this->breadcrumbs = [
    strip_tags($model->title)
];

?>

<?php if($this->webp_support) : ?>
    <?php $backHeader = $model->getImageUrlWebp(0, 0, true, null, 'image'); ?>
<?php else : ?>
    <?php $backHeader = $model->getImageNewUrl(0, 0, true, null, 'image'); ?>
<?php endif; ?>

<div class="page-header-main masterClass-header-main" style="<?= $model->image ? 'background: url('.$backHeader.') no-repeat;': ''?>">
	<div class="content fl fl-wr-w">
		<div class="page-header-main__info">
			<?php $this->widget('application.components.MyTbBreadcrumbs', [
				'links' => $this->breadcrumbs,
			]); ?>
			<h1 class="color-white"><?= $model->getTitle(); ?></h1>
			<div class="page-header-main__desc color-white">
				<?php //= $model->body_short; ?>
                <div class="fl">
                    <a class="but but-yellow but-animation" href="<?= Yii::app()->createUrl('/masterclass/masterclass/afisha'); ?>"><span>Календарь мастер-классов</span></a>
                </div>
			</div>
		</div>
		<div class="page-header-main__img">
			<picture>
				<source media="(min-width: 1px)" srcset="<?= $model->getImageUrlWebp(0, 0, true, null, 'icon', Yii::app()->getModule('page')->uploadPath2); ?>" type="image/webp">
				<source media="(min-width: 1px)" srcset="<?= $model->getImageNewUrl(0, 0, true, null, 'icon', Yii::app()->getModule('page')->uploadPath2); ?>">
				
				<img src="<?= $model->getImageNewUrl(0, 0, true, null, 'icon'); ?>" alt="">
			</picture>
		</div>
	</div>
</div>
    
<div class="page-content">
    <div class="content">
        
        <form id="masterclass-filter" name="masterclass-filter" method="get" action="<?= Yii::app()->createUrl('/masterclass/masterclass/index'); ?>">
            <?php $this->widget('application.modules.masterclass.widgets.filters.ThemeMasterclassFilterWidget'); ?>
        </form>

		<?php  $this->widget(
            'application.components.FtListView',
            [
                'dataProvider' => $dataProvider,
                'id' => 'masterclass-box',
                'itemView' => '_item',
                'template'=>'
                    {items}
                    {pager}
                ',
                'itemsCssClass' => "news-box",
                'htmlOptions' => [
                    'class' => 'masterclass-box-listView'
                ],
                'ajaxUpdate'=>true,
                'enableHistory' => true,
                'pagerCssClass' => 'pagination-box',
                'pager' => [
                    'class' => 'application.components.ShowMorePager',
                    'buttonText' => 'Показать еще',
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

<div class="masterclass-stillQuestions-section">
    <?php /* Блок Календарь мастер-классов и мероприятий */?>
    <?php $this->widget('application.modules.contentblock.widgets.ContentMyBlockWidget', [
        'id' => 3,
        'view' => 'stillQuestions-box-masterclass'
    ]); ?>
</div>