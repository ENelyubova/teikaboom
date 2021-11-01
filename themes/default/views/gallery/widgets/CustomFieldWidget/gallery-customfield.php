<?php $photos = $model->getAttributeValue($code)['gallery']; ?>
<?php if($photos) : ?>
	<?php 
		$count = count($photos); 

		if($count == 1) {
			$class = 'img-col-12';
		} elseif(($count % 2 == 0) && $count <= 4) {
			$class = 'img-col-6';
		} ?>
	<div class="image-box fl fl-wr-w fl-al-it-c">
		<?php foreach ($photos as $key => $photo): ?>
			<div class="image-box__item <?= $class; ?> box-style-img">
				<a class="fl fl-al-it-c fl-ju-co-c" data-fancybox="image" href="<?= $model->getFieldGalImageUrl(0, 0, false,  $photo['image']); ?>">
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