<div class="stillQuestions-box fl">
    <div class="content fl fl-wr-w fl-ju-co-sp-b">
        <div class="stillQuestions-box__content">
            <div class="stillQuestions-box__header">
                <?= $block->name; ?>
            </div>
            <div class="stillQuestions-box__desc t-stl">
                <?= Yii::app()->controller->decodeWidgets($block->content); ?>
            </div>
        </div>
        <div class="stillQuestions-box__contact">
            <div class="stillQuestions-box__header">
                <?= $block->description; ?>
            </div>
        </div>
        <div class="stillQuestions-box__img">
            <picture>
				<source media="(min-width: 641px)" srcset="<?= $block->getImageUrlWebp(0, 0, true, null, 'image'); ?>" type="image/webp">
				<source media="(min-width: 641px)" srcset="<?= $block->getImageNewUrl(0, 0, true, null, 'image'); ?>">
				
                <source media="(min-width: 1px)" srcset="<?= $block->getImageUrlWebp(640, 430, true, null, 'image'); ?>" type="image/webp">
				<source media="(min-width: 1px)" srcset="<?= $block->getImageNewUrl(640, 430, true, null, 'image'); ?>">
				
				<img src="<?= $block->getImageNewUrl(0, 0, true, null, 'image'); ?>" alt="">
			</picture>
        </div>
    </div>
</div>