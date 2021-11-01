<?php if(!empty($pages)): ?>
	<div class="personalization-home">
		<div class="content fl fl-wr-w fl-al-it-c fl-ju-co-sp-b">
			<div class="personalization-home__info txt-style">
				<div class="box-style">
					<div class="box-style__header">
						<div class="box-style__heading"><?= $pages->title_short; ?></div>
					</div>
				</div>
				<div class="personalization-home__content fl fl-wr-w fl-ju-co-sp-b">
					<?php $str = explode('<hr>', $pages->body_short); ?>
					<div class="personalization-home__content_left">
						<?php if(isset($str[0])) : ?>
							<?= $str[0]; ?>
						<?php endif; ?>
					</div>
					<div class="personalization-home__content_right">
						<?php if(isset($str[1])) : ?>
							<?= $str[1]; ?>
						<?php endif; ?>
					</div>
				</div>
				<div class="personalization-home__but">
					<a class="but but-green but-svg but-svg-right but-animation" href="<?= Yii::app()->createUrl('/page/page/view', ['slug' => $pages->slug]); ?>">
						<span>Больше информации</span>
						<?= file_get_contents('.'. Yii::app()->getTheme()->getAssetsUrl() . '/images/svg/but-arrow-right.svg'); ?>
					</a>
				</div>
			</div>
			<div class="personalization-home__img">
				<?= CHtml::image($pages->getIconUrl(), ''); ?>
			</div>
		</div>
	</div>
<?php endif; ?>
