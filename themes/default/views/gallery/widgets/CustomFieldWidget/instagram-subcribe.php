<?php if($model) : ?>
	<?php 
		$butName = $model->getAttributeValue($code)['butName'];
		$butLink = $model->getAttributeValue($code)['butLink'];
		$photos  = $model->getAttributeValue($code)['gallery'];
	 ?>
	<div class="insta-section">
		<div class="content fl fl-ju-co-sp-b">
			<div class="insta-section__header insta-header">
				<div class="insta-header__heading h1Home-style">
                    <?= $model->getAttributeValue($code)['name']; ?>
                    <span class="star-polygonal-white"></span>
                </div>
                <div class="insta-header__desc t-stl">
                    <?= $model->getAttributeValue($code)['value']; ?>
                </div>
                <?php if($butLink) : ?>
					<div class="insta-header__but fl">
						<a class="but but-pink but-animate-transform" target="_blank" href="<?= $butLink; ?>">
							<?= ($butName) ?: 'Подписаться'; ?>
						</a>
					</div>
				<?php endif; ?>
			</div>
			<div class="insta-section__body">
				<?php if($photos) : ?>
					<div class="insta-box fl fl-wr-w fl-al-it-c">
						<?php foreach ($photos as $key => $photo): ?>
							<?php if($key < 2) : ?>
								<div class="insta-box__item">
									<?php if($fancybox) : ?>
										<a class="fl fl-al-it-c fl-ju-co-c" data-fancybox="image" href="<?= $model->getFieldGalImageUrl(0, 0, false,  $photo['image']); ?>">
									<?php endif; ?>
					                    <picture>
								            <source media="(min-width: 1px)" srcset="<?= $model->geFieldGalImageWebp(0, 0, false,  $photo['image']); ?>" type="image/webp">
								            <source media="(min-width: 1px)" srcset="<?= $model->getFieldGalImageUrl(0, 0, false,  $photo['image']); ?>">

								            <img src="<?= $model->getFieldGalImageUrl(0, 0, false,  $photo['image']); ?>" alt="<?= $data->title; ?>">
								        </picture>
									<?php if($fancybox) : ?>
										</a>
									<?php endif; ?>
								</div>
							<?php else: ?>
								<?php break; ?>
							<?php endif; ?>
						<?php endforeach ?>
					</div>
				<?php endif; ?>
			</div>
		</div>
	</div>
<?php endif; ?>