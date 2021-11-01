<?php if($models) : ?>
	<?php $phone= str_replace([' ', '(', ')', '-'], '', $models->value); ?>

    <?php if (substr($phone,0,1) == 8) {
        $phone[0] = 7;
        $phone = '+'.$phone;
    } ?>

	<a class="contact-phone" href="tel:<?= $phone; ?>"><?= $models->value ?></a>
<?php endif; ?>
