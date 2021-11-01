<?php if($models->images) : ?>
	<div class="advantages-box">
		<?php foreach ($models->images(['order' => 'position ASC']) as $key => $item): ?>
			<div class="advantages-box__item">
				<div class="advantages-box__img">
					<?= CHtml::image($item->getImageUrl(), ""); ?>
				</div>
				<div class="advantages-box__name">
					<?= $item->name; ?>
				</div>
			</div>
		<?php endforeach ?>
	</div>
<?php endif; ?>