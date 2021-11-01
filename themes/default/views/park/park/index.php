<?php

$this->title = $model->meta_title ?: $model->title;
$this->description = $model->meta_description ?: Yii::app()->getModule('yupe')->siteDescription;
$this->keywords = $model->meta_keywords ?: Yii::app()->getModule('yupe')->siteKeyWords;

$this->breadcrumbs = ['Наши парки'];
?>



<div class="page-content page-content-carbrands">
    <div class="page-header-main">
		<div class="content">
			<?php $this->widget('application.components.MyTbBreadcrumbs', [
		        'links' => $this->breadcrumbs,
		    ]); ?>
			<h1><?php //= $model->getTitle(); ?></h1>
		</div>
	</div>
	<div class="content">
		<?= $model->body_short; ?>
    </div>
</div>