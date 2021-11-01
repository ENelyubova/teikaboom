<?php if($models) : ?>
	<?php foreach ($models as $key => $data) : ?>
		<a href="<?= $data->value; ?>">
			<?php if($data->image) : ?>
				<?php 
				$file = $data->getImageUrl();
				$ext = pathinfo($file, PATHINFO_EXTENSION);
	    		if($ext == 'svg') :
	    			echo CHtml::image($file, '');
	    		else : ?>
	    			<picture>
			            <source media="(min-width: 1px)" srcset="<?= $data->getImageUrlWebp(0, 0, false, null, 'image'); ?>" type="image/webp">
			            <source media="(min-width: 1px)" srcset="<?= $data->getImageNewUrl(0, 0, false, null, 'image'); ?>">

			            <img src="<?= $data->getImageNewUrl(0, 0, true, null, 'image'); ?>" alt="">
			        </picture>
				<?php endif; ?>
			<?php endif; ?>
		</a>
	<?php endforeach; ?>
<?php endif; ?>
