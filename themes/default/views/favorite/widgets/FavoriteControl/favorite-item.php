<?php if(false === $favorite->has($product->id)):?>
    <a href="#" class="but but-circle but-border product-vertical-extra__button yupe-store-favorite-add fl fl-al-it-c fl-ju-co-c" data-id="<?= $product->id;?>">
		<i class="icon icon-load"></i>
		<?= file_get_contents('.'. Yii::app()->getTheme()->getAssetsUrl() . '/images/svg/favorite.svg'); ?>
    </a>
<?php else:?>
    <a href="#" class="but but-circle but-border product-vertical-extra__button yupe-store-favorite-remove text-error fl fl-al-it-c fl-ju-co-c" data-id="<?= $product->id;?>">
		<i class="icon icon-load"></i>
		<?= file_get_contents('.'. Yii::app()->getTheme()->getAssetsUrl() . '/images/svg/favorite.svg'); ?>
	</a>
<?php endif;?>