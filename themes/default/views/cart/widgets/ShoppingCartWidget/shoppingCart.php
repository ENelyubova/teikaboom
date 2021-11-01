<?php
$currency = Yii::app()->getModule('store')->currency;
?>
<div class="but-cart but-header js-cart fl fl-al-it-c fl-ju-co-c" id="cart-widget" data-cart-widget-url="<?= Yii::app()->createUrl('/cart/cart/widget'); ?>">
    <?php if (empty(Yii::app()->cart->isEmpty())): ?>
        <a class="fl fl-al-it-c fl-ju-co-c" href="<?= Yii::app()->createUrl('/cart/cart/index') ?>">
    <?php endif; ?>
        <div class="but-cart__icon but-header__icon">
            <?= file_get_contents('.'. Yii::app()->getTheme()->getAssetsUrl() . '/images/svg/cart.svg'); ?>
            <div class="but-cart__count but-header__count fl fl-al-it-c fl-ju-co-c <?= (empty(Yii::app()->cart->isEmpty())) ? 'active' : 'active'; ?>">
                <?= Yii::app()->cart->getItemsCount(); ?>
            </div>
        </div>
        <div class="but-cart__text but-header__text">
            <?= Yii::t("CartModule.cart", "Корзина"); ?>
        </div>
    <?php if (empty(Yii::app()->cart->isEmpty())): ?>
        </a>
    <?php endif; ?>
</div>