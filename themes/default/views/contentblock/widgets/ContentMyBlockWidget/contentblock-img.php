<picture>
    <source media="(min-width: 1px)" srcset="<?= $block->getImageUrlWebp(0, 0, true, null, 'image'); ?>" type="image/webp">
    <source media="(min-width: 1px)" srcset="<?= $block->getImageNewUrl(0, 0, true, null, 'image'); ?>">
    
    <img src="<?= $block->getImageNewUrl(0, 0, true, null, 'image'); ?>" alt="">
</picture>