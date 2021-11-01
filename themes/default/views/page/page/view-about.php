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


<div class="page-header-main about-header-main" style="<?= $model->image ? 'background: url('.$backHeader.') no-repeat;': ''?>">
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

<div class="page-content aboutView">
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
			<div class="aboutView-content">
				<div class="aboutView-content__item aboutView-item aboutView-item_0 fl fl-wr-w">
					<div class="aboutView-item__text">
						<div class="aboutView-item__h1 restaurantView-title"><?= $model->getAttributeValue('code1')['name']; ?></div>
						<div class="aboutView-item__subtitle"><?= $model->getAttributeValue('code1')['value']; ?></div>
					</div>
					<div class="aboutView-item__desc fl fl-di-c">
						<div class="aboutView-item__image">
							<picture class="absolute-img">
							    <source media="(min-width: 1px)" srcset="<?= $model->geFieldImageWebp(0, 0, false,  $model->getAttributeValue('code2')['image']); ?>" type="image/webp">
							    <source media="(min-width: 1px)" srcset="<?= $model->getFieldImageUrl(0, 0, false,  $model->getAttributeValue('code2')['image']); ?>">

							    <img src="<?= $model->getFieldImageUrl(0, 0, false,  $model->getAttributeValue('code2')['image']); ?>" alt="">
							</picture>
						</div>
						<div class="aboutView-item__quote bold">
							<blockquote>
								<?= $model->getAttributeValue('code2')['value']; ?>
							</blockquote>
						</div>
					</div>
				</div>

				<div class="aboutView-content__item aboutView-item aboutView-item_1 fl fl-wr-w">
					<div class="aboutView-item__text">
						<h2><?= $model->getAttributeValue('code3')['name']; ?></h2>
						<div class="aboutView-item__thumb">
							<picture class="absolute-img">
							    <source media="(min-width: 1px)" srcset="<?= $model->geFieldImageWebp(0, 0, false,  $model->getAttributeValue('code3')['image']); ?>" type="image/webp">
							    <source media="(min-width: 1px)" srcset="<?= $model->getFieldImageUrl(0, 0, false,  $model->getAttributeValue('code3')['image']); ?>">

							    <img src="<?= $model->getFieldImageUrl(0, 0, false,  $model->getAttributeValue('code3')['image']); ?>" alt="">
							</picture>
						</div>
					</div>
					<div class="aboutView-item__desc">
						<?= $model->getAttributeValue('code3')['value']; ?>
						<div class="aboutView-item__image">
							<?php $this->widget('application.modules.gallery.widgets.CustomFieldWidget', [
							    'id' => $model->id,
							    'code' => 'code3',
							    'view' => 'about-page-img'
							]); ?>
						</div>
					</div>
				</div>

				<div class="aboutView-content__item aboutView-item aboutView-item_2 mt">
					<h2><?= $model->getAttributeValue('code4')['name']; ?></h2>
					<div class="aboutView-item__desc bold ml-auto"><?= $model->getAttributeValue('code4')['value']; ?></div>
					<div class="restaurantView-carousel slick-slider">
	            		<?php $this->widget('application.modules.gallery.widgets.CustomFieldWidget', [
						    'id' => $model->id,
						    'fancybox' => true,
						    'code' => 'code4',
						    'view' => 'restaurant-menu-carousel'
						]); ?>
	            	</div>
	            	<div class="aboutView-content__bottom fl fl-wr-w">
	            		<div class="aboutView-item__text">
	            			<a href="#" class="but but-pink but-animation">Наши аттракционы</a>
	            		</div>
	            		<div class="aboutView-item__desc">
	            			<p>Для детей постарше создано пространство с 30 видами аттракционов и игровых зон, среди которых: батуты, качели, горки, ватрушки, лабиринты и воздушные пушки.</p>
	            		</div>
	            	</div>
				</div>

				<div class="aboutView-content__item aboutView-item aboutView-item_3 mt fl fl-wr-w">
					<div class="aboutView-item__text">
						<h2><?= $model->getAttributeValue('code5')['name']; ?></h2>
						<?= $model->getAttributeValue('code5')['value']; ?>
					</div>
					<div class="aboutView-item__desc">
						<div class="aboutView-item__image">
							<picture class="absolute-img">
							    <source media="(min-width: 1px)" srcset="<?= $model->geFieldImageWebp(0, 0, false,  $model->getAttributeValue('code5')['image']); ?>" type="image/webp">
							    <source media="(min-width: 1px)" srcset="<?= $model->getFieldImageUrl(0, 0, false,  $model->getAttributeValue('code5')['image']); ?>">
							
							    <img src="<?= $model->getFieldImageUrl(0, 0, false,  $model->getAttributeValue('code5')['image']); ?>" alt="">
							</picture>
						</div>
					</div>
				</div>

				<div class="aboutView-content__item aboutView-item aboutView-item_4 mt fl fl-wr-w">
					<div class="aboutView-item__text fl fl-di-c fl-ju-co-sp-b">
						<h2><?= $model->getAttributeValue('code6')['name']; ?></h2>
						<?php if($model->getAttributeValue('code6')['name']): ?>
							<div class="aboutView-item__video">
								<video id="videoPlayer" width="445" height="270" poster="/uploads/promo.jpg" onTimeUpdate="progressUpdate()">
								    <source src="/uploads/Teikaboom.mp4" type="video/mp4">
								    <source src="/uploads/Teikaboom.webm" type="video/webm">
								    <source src="/uploads/Teikaboom.ogv" type="video/ogv">
								</video>
								<div class="videoNav">
								    <a id="playBtn">
								    	<img src="<?= $this->mainAssets . '/images/about/play.png' ?>">
								    </a>
								</div>
								<div class="barContainer">
								  <div id="durationBar">
								    <div id="positionBar"></div>
								  </div>
								</div>
							</div>
						<?php endif; ?>
					</div>
					<div class="aboutView-item__desc">
						<?= $model->getAttributeValue('code6')['value']; ?>
					</div>
				</div>
			</div>

			<div class="about-footer-image">
				<img src="<?= $this->mainAssets . '/images/about/bottom-img.jpg' ?>">
			</div>
        </div>
    </div>
</div>