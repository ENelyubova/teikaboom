<?php if($model) : ?>
	<?php 
		$butName = $model->getAttributeValue($code)['butName'];
		$butLink = $model->getAttributeValue($code)['butLink'];
		$photos  = $model->getAttributeValue($code)['gallery'];
	 ?>
	<div class="videoPress-section">
		<div class="content fl fl-al-it-c fl-ju-co-sp-b">
			<div class="videoPress-section__header videoPress-header">
				<div class="videoPress-header__heading h1Home-style">
                    <?= $model->getAttributeValue($code)['name']; ?>
                </div>
			</div>
			<div class="videoPress-section__body">
				<?php if($photos) : ?>
					<div class="videoPress-box videoPress-box-carousel fl fl-wr-w fl-al-it-c">
						<?php foreach ($photos as $key => $photo): ?>
							<div class="videoPress-box__item">
								<a class="videoPress-box__play fl fl-al-it-c fl-ju-co-c" data-fancybox="iframe" href="<?= $photo['desc']; ?>">
				                    <picture>
							            <source media="(min-width: 1px)" srcset="<?= $model->geFieldGalImageWebp(0, 0, false,  $photo['image']); ?>" type="image/webp">
							            <source media="(min-width: 1px)" srcset="<?= $model->getFieldGalImageUrl(0, 0, false,  $photo['image']); ?>">

							            <img src="<?= $model->getFieldGalImageUrl(0, 0, false,  $photo['image']); ?>" alt="<?= $data->title; ?>">
							        </picture>
								</a>
							</div>
						<?php endforeach ?>
					</div>
				<?php endif; ?>
			</div>
		</div>
	</div>
<?php endif; ?>