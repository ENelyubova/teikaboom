<?php $photos = $model->getAttributeValue($code)['gallery']; ?>
<?php if($photos) : ?>
	<div class="gal-list-carousel slick-slider slick-slider">
		<?php foreach ($photos as $key => $photo): ?>
			<div class="gal-list-carousel__item">
				<div class="gal-list-carousel__img box-style-img">
					<?php if($fancybox) : ?>
						<a class="gal-list-carousel__link fl fl-al-it-c fl-ju-co-c" data-fancybox="image" href="<?= $model->getFieldGalImageUrl(0, 0, false,  $photo['image']); ?>">
					<?php endif; ?>
		                    <picture>
					            <source media="(min-width: 1px)" srcset="<?= $model->geFieldGalImageWebp(0, 0, false,  $photo['image']); ?>" type="image/webp">
					            <source media="(min-width: 1px)" srcset="<?= $model->getFieldGalImageUrl(0, 0, false,  $photo['image']); ?>">

					            <img src="<?= $model->getFieldGalImageUrl(0, 0, false,  $photo['image']); ?>" alt="<?= $photo['title']; ?>">
					        </picture>
					<?php if($fancybox) : ?>
		                </a>
					<?php endif; ?>
				</div>
			</div>
		<?php endforeach ?>
	</div>
<?php endif; ?>