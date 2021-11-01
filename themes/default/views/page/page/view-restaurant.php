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


<div class="page-header-main restaurant-header-main" style="<?= $model->image ? 'background: url('.$backHeader.') no-repeat;': ''?>">
	<div class="content fl fl-wr-w">
		<div class="page-header-main__info">
			<?php $this->widget('application.components.MyTbBreadcrumbs', [
				'links' => $this->breadcrumbs,
			]); ?>
			<h1 class="color-white m-b-12">КАФЕ И РЕСТОРАНЫ</h1>
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

<div class="page-content restaurantView">
	<div class="content">
		<?php // Галерея ?>
        <?php $photos = $model->photos(['order' => 'position DESC']); ?>
		<?php if($photos) : ?>
		    <div class="parkView-carousel carousel-arrow-circle slick-slider">
		        <?php foreach ($photos as $key => $data) : ?>
		            <?php if($this->webp_support) : ?>
		                <?php $originImage = $data->getImageUrlWebp(0, 0, true, null, 'image'); ?>
		            <?php else : ?>
		                <?php $originImage = $data->getImageNewUrl(0, 0, true, null, 'image'); ?>
		            <?php endif; ?>
		            <div class="parkView-carousel__item">
		                <div class="parkView-carousel__img box-style-img">
		                    <a class="parkView-carousel__link" data-fancybox="gallery-<?= $model->id; ?>" href="<?= $originImage; ?>">
		                        <picture>
		                            <source media="(min-width: 1601px)" srcset="<?= $data->getImageUrlWebp(538, 320, false, null, 'image'); ?>" type="image/webp">
		                            <source media="(min-width: 1601px)" srcset="<?= $data->getImageNewUrl(538, 320, false, null, 'image'); ?>">
		                            
		                            <source media="(min-width: 1241px)" srcset="<?= $data->getImageUrlWebp(480, 285, false, null, 'image'); ?>" type="image/webp">
		                            <source media="(min-width: 1241px)" srcset="<?= $data->getImageNewUrl(480, 285, false, null, 'image'); ?>">
		                            
		                            <source media="(min-width: 1001px)" srcset="<?= $data->getImageUrlWebp(400, 240, false, null, 'image'); ?>" type="image/webp">
		                            <source media="(min-width: 1001px)" srcset="<?= $data->getImageNewUrl(400, 240, false, null, 'image'); ?>">

		                            <source media="(min-width: 641px)" srcset="<?= $data->getImageUrlWebp(340, 200, false, null, 'image'); ?>" type="image/webp">
		                            <source media="(min-width: 641px)" srcset="<?= $data->getImageNewUrl(340, 200, false, null, 'image'); ?>">
		                            
		                            <source media="(min-width: 1px)" srcset="<?= $data->getImageUrlWebp(270, 200, false, null, 'image'); ?>" type="image/webp">
		                            <source media="(min-width: 1px)" srcset="<?= $data->getImageNewUrl(270, 200, false, null, 'image'); ?>">

		                            <img src="<?= $data->getImageNewUrl(538, 320, false, null, 'image'); ?>" alt="">
		                        </picture>
		                    </a>
		                </div>
		            </div>
		        <?php endforeach; ?>
		    </div>
		    <?php $fancybox = $this->widget(
		        'gallery.extensions.fancybox3.AlFancybox', [
		            'target' => "[data-fancybox=gallery-{$model->id}]",
		            'lang'   => 'ru',
		            'config' => [
		                'animationEffect' => "fade",
		                'buttons' => [
		                    "zoom",
		                    "close",
		                ]
		            ],
		        ]
		    ); ?>
		<?php endif; ?>

		<div class="back-white-content">
			<div class="restaurantView__title restaurantView-title">Информация <br><strong>о ресторанах и кафе</strong> </div>

            <div class="restaurantView-content">
            	<div class="restaurantView-top fl fl-wr-w fl-ju-co-sp-b">
            		<div class="restaurantView-top__h1 restaurantView-title fs65">
            			<?= $model->getAttributeValue('code1')['name']; ?>
            		</div>
            		<div class="restaurantView-top__img">
            			<picture class="absolute-img">
						    <source media="(min-width: 1px)" srcset="<?= $model->geFieldImageWebp(0, 0, false,  $model->getAttributeValue('code1')['image']); ?>" type="image/webp">
						    <source media="(min-width: 1px)" srcset="<?= $model->getFieldImageUrl(0, 0, false,  $model->getAttributeValue('code1')['image']); ?>">

						    <img src="<?= $model->getFieldImageUrl(0, 0, false,  $model->getAttributeValue('code1')['image']); ?>" alt="">
						</picture>
            		</div>
            	</div>

            	<div class="restaurantView-body fl fl-wr-w fl-ju-co-sp-b">
            		<div class="restaurantView-body__img">
            			<picture class="absolute-img">
						    <source media="(min-width: 1px)" srcset="<?= $model->geFieldImageWebp(0, 0, false,  $model->getAttributeValue('code2')['image']); ?>" type="image/webp">
						    <source media="(min-width: 1px)" srcset="<?= $model->getFieldImageUrl(0, 0, false,  $model->getAttributeValue('code2')['image']); ?>">

						    <img src="<?= $model->getFieldImageUrl(0, 0, false,  $model->getAttributeValue('code2')['image']); ?>" alt="">
						</picture>
            		</div>
            		<div class="restaurantView-body__text">
            			<div class="restaurantView__label"><?= $model->getAttributeValue('code2')['name']; ?></div>
            			<?= $model->getAttributeValue('code2')['value']; ?>
            		</div>
            	</div>

            	<div class="restaurantView-carousel slick-slider">
            		<?php $this->widget('application.modules.gallery.widgets.CustomFieldWidget', [
					    'id' => $model->id,
					    'fancybox' => true,
					    'code' => 'gallery',
					    'view' => 'restaurant-menu-carousel'
					]); ?>
            	</div>

            	<div class="restaurantView-contacts">
            		<div class="restaurantView-contacts__title restaurantView-title fs32"><?= $model->getAttributeValue('code3')['name']; ?></div>
            		<?= $model->getAttributeValue('code3')['value']; ?>
            	</div>
            </div>
        </div>
    </div>
</div>

<?php /* Блок остались вопросы */?>
<?php $this->widget('application.modules.contentblock.widgets.ContentMyBlockWidget', [
    'id' => 8,
    'view' => 'stillQuestions-box'
]); ?>



