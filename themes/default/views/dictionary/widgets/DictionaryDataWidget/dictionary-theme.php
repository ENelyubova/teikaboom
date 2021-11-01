<?php if($models) : ?>
	<div class="wrapper-down js-wrapTheme js-wrap">
		<div class="wrapper-down__header js-wrap-header fl fl-al-it-c">
			<span></span>
			<i class="fa fa-caret-down" aria-hidden="true"></i>
		</div>
		<div class="wrapper-down__body">
			<div class="wrapper-down__content">
				<ul>
					<?php foreach ($models as $key => $data) : ?>
						<li class="js-theme-item" data-value="<?= $data->value; ?>"><?= $data->value; ?></li>
					<?php endforeach; ?>
				</ul>
			</div>
		</div>
	</div>

	<?php Yii::app()->clientScript->registerScript('js-wrap-script', "
		var header = $('.js-wrapTheme .js-theme-item').first().text();
    	$('.js-wrapTheme .js-wrap-header span').text(header);
    	$('#StandartForm_theme').val(header);
    	
    	$('.js-theme-item').on('click', function(){
    		var text = $(this).text();
    		$(this).parents('.js-wrapTheme').find('.js-wrap-header span').text(text);
    		$('#StandartForm_theme').val(text);
    		return false;
		});
	") ?>
<?php endif; ?>