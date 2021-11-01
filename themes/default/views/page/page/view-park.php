<?php
/* @var $model Page */
/* @var $this PageController */

if ($model->layout) {
    $this->layout = "//layouts/{$model->layout}";
}

$this->title = $model->meta_title ?: $model->title;
$this->breadcrumbs = $this->getBreadCrumbs();
$this->description = $model->meta_description ?: Yii::app()->getModule('yupe')->siteDescription;
$this->keywords = $model->meta_keywords ?: Yii::app()->getModule('yupe')->siteKeyWords;
?>

<?php if($this->webp_support) : ?>
    <?php $backHeader = $model->getImageUrlWebp(0, 0, true, null, 'image'); ?>
<?php else : ?>
    <?php $backHeader = $model->getImageNewUrl(0, 0, true, null, 'image'); ?>
<?php endif; ?>


<div class="page-header-main park-header-main" style="<?= $model->image ? 'background: url('.$backHeader.') no-repeat;': ''?>">
	<div class="content fl fl-wr-w">
		<div class="page-header-main__info">
			<?php $this->widget('application.components.MyTbBreadcrumbs', [
				'links' => $this->breadcrumbs,
			]); ?>
			<h1 class="color-white m-b-12"><?= $model->getTitle(); ?></h1>
			<div class="page-header-main__desc color-white">
				<?= $model->body_short; ?>
			</div>
		</div>
		<div class="page-header-main__img">
			<picture>
				<source media="(min-width: 1px)" srcset="<?= $model->getImageUrlWebp(0, 0, true, null, 'icon', Yii::app()->getModule('page')->uploadPath2); ?>" type="image/webp">
				<source media="(min-width: 1px)" srcset="<?= $model->getImageNewUrl(0, 0, true, null, 'icon', Yii::app()->getModule('page')->uploadPath2); ?>">
				
				<img src="<?= $model->getImageNewUrl(0, 0, true, null, 'icon', Yii::app()->getModule('page')->uploadPath2); ?>" alt="">
			</picture>
		</div>
	</div>
</div>

<div class="page-content">
	<div class="content">
        <?php $this->widget('application.modules.park.widgets.ParkWidget'); ?>
    </div>
</div>