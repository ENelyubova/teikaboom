<?php if($models->images) : ?>
	<div class="marka-box">
		<?php foreach ($models->images(['order' => 'position ASC']) as $key => $item): ?>
			<div class="marka-box__item">
				<div class="marka-box__img">
					<?= CHtml::image($item->getImageUrl(), $item->alt); ?>
				</div>
			</div>
		<?php endforeach ?>
	</div>
<?php endif; ?>