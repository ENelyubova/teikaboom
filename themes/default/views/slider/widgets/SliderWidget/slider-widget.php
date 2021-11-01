<div class="slide-box slide-box-carousel slick-slider">
	<?php foreach ($models as $key => $data): ?>
		<?php $big = 'image'; ?>
		<?php $xs = 'image'; ?>

		<?php if($data->image_big) : ?>
			<?php $big = 'image_big'; ?>
		<?php endif; ?>

		<?php if($data->image_xs) : ?>
			<?php $xs = 'image_xs'; ?>
		<?php endif; ?>

	    <div class="slide-box__item">
			<div class="slide-box__info">
				<div class="slide-box__text">
					<?= $data->name; ?>
				</div>
			</div>
			<div class="slide-box__img">
				<picture>
		            <source media="(min-width: 1921px)" srcset="<?= $data->getImageUrlWebp(0, 0, true, null, $big); ?>" type="image/webp">
		            <source media="(min-width: 1921px)" srcset="<?= $data->getImageNewUrl(0, 0, true, null, $big); ?>">

	            	<source media="(min-width: 1601px)" srcset="<?= $data->getImageUrlWebp(0, 0, true, null, 'image'); ?>" type="image/webp">
		            <source media="(min-width: 1601px)" srcset="<?= $data->getImageNewUrl(0, 0, true, null, 'image'); ?>">
	            	
					<source media="(min-width: 1301px)" srcset="<?= $data->getImageUrlWebp(1600, 700, true, null, 'image'); ?>" type="image/webp">
		            <source media="(min-width: 1301px)" srcset="<?= $data->getImageNewUrl(1600, 700, true, null, 'image'); ?>">
					
					<source media="(min-width: 641px)" srcset="<?= $data->getImageUrlWebp(1400, 675, true, null, 'image'); ?>" type="image/webp">
		            <source media="(min-width: 641px)" srcset="<?= $data->getImageNewUrl(1400, 675, true, null, 'image'); ?>">
					
					<source media="(min-width: 541px)" srcset="<?= $data->getImageUrlWebp(640, 360, true, null, 'image'); ?>" type="image/webp">
		            <source media="(min-width: 541px)" srcset="<?= $data->getImageNewUrl(640, 360, true, null, 'image'); ?>">

	            	<source media="(min-width: 401px)" srcset="<?= $data->getImageUrlWebp(640, 1025, false, null, $xs); ?>" type="image/webp">
		            <source media="(min-width: 401px)" srcset="<?= $data->getImageNewUrl(640, 1025, false, null, $xs); ?>">

		            <source media="(min-width: 1px)" srcset="<?= $data->getImageUrlWebp(400, 642, false, null, $xs); ?>" type="image/webp">
		            <source media="(min-width: 1px)" srcset="<?= $data->getImageNewUrl(400, 642, false, null, $xs); ?>">

		            <img src="<?= $data->getImageNewUrl(0, 0, true, null, 'image'); ?>" alt="">
		        </picture>
			</div>
	    </div>
	<?php endforeach ?>
</div>