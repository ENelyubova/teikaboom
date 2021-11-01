<?php if($models) : ?>
	<ul>
		<?php foreach ($models as $key => $data) : ?>
			<li><?= $data->value; ?></li>
		<?php endforeach; ?>
	</ul>
<?php endif; ?>