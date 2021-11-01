<?php
/* @var $model Order */
$mainAssets = Yii::app()->getTheme()->getAssetsUrl();
// Yii::app()->getClientScript()->registerCssFile($mainAssets . '/css/order-frontend.css');
// Yii::app()->getClientScript()->registerScriptFile($mainAssets . '/js/store.js');

$this->title = Yii::t('OrderModule.order', 'Order #{n}', [$model->id]);
$this->breadcrumbs = [Yii::t('OrderModule.order', 'Order #{n}', [$model->id])];
?>
<?php $array = Yii::app()->user->getFlashes(); ?>

<div id="ordersuccessModal" class="modal modal-my fade" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div data-dismiss="modal" class="modal-close"><div></div></div>
                <h4 class="modal-title">Уведомление</h4>
            </div>
            <div class="modal-body">
                <div class="message-success">
                    <!-- Ожидайте, ваш заказ принят. В ближайшее время с вами свяжется наш оператор для подтверждения заказа. -->
                    <?php foreach ($array as $key => $message) : ?>
                            <?php echo '<div>' . $message . "</div>\n"; ?>
                       <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php //echo $array.length(); ?>
<?php if(!empty($array)) : ?>
    <?php Yii::app()->getClientScript()->registerScript(
        "order-success-Modal",
        "
            $('#ordersuccessModal').modal('show');
            setTimeout(function(){
                $('#ordersuccessModal').modal('hide');
            }, 6000);
    "); ?>
<?php endif; ?>

<div class="page-content pay">
    <div class="content">
        <?php $this->widget('application.components.MyTbBreadcrumbs', [
            'links' => $this->breadcrumbs,
        ]); ?>
        <h1><?= Yii::t("OrderModule.order", "Order #"); ?><?= $model->id; ?>
            <small>[<?= CHtml::encode($model->getStatusTitle()); ?>]</small>
        </h1>
        <?//= Yii::app()->user->getFlash('callback-success') ?>
        <div class="pay-details">
            <div class="pay-details__items">
                <div class="pay-details__left">
                    <?= CHtml::activeLabel($model, 'date'); ?>
                </div>
                <div class="pay-details__right">
                    <?= $model->date; ?>
                </div>
            </div>
            <div class="pay-details__items">
                <div class="pay-details__left">
                    <?= CHtml::activeLabel($model, 'delivery_id'); ?>
                </div>
                <div class="pay-details__right">
                    <?php if (!empty($model->delivery)) : ?>
                        <?= CHtml::encode($model->delivery->name); ?>
                    <?php endif; ?>
                </div>
            </div>
            <div class="pay-details__items">
                <div class="pay-details__left">
                    <?= CHtml::activeLabel($model, 'name'); ?>
                </div>
                <div class="pay-details__right">
                    <?= CHtml::encode($model->name); ?>
                </div>
            </div>
            <div class="pay-details__items">
                <div class="pay-details__left">
                    <?= CHtml::activeLabel($model, 'phone'); ?>
                </div>
                <div class="pay-details__right">
                    <?= CHtml::encode($model->phone); ?>
                </div>
            </div>
            <div class="pay-details__items">
                <div class="pay-details__left">
                    <?= CHtml::activeLabel($model, 'email'); ?>
                </div>
                <div class="pay-details__right">
                    <?= CHtml::encode($model->email); ?>
                </div>
            </div>
            <?php if ($model->house) : ?>
                <div class="pay-details__items">
                    <div class="pay-details__left">
                        <label><?= Yii::t("OrderModule.order", "Address"); ?></label>
                    </div>
                    <div class="pay-details__right">
                        <?php //= CHtml::encode($model->getAddress()); ?>
                        <?= $model->house; ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>
        <div class="pay-box">
            <div class="pay-box__header">
                <?= Yii::t("OrderModule.order", "Order details"); ?>
            </div>
            <?php foreach ((array)$model->products as $key => $position) : ?>
                <div class="pay-box__items">
                    <div class="pay-box__name">
                        <div class="media">
                            <?php $productUrl = ProductHelper::getUrl($position->product); ?>
                            <a class="img-thumbnail" href="<?= $productUrl; ?>">
                                <img class="media-object" src="<?= $position->product->getImageUrl(72, 72); ?>">
                            </a>

                            <div class="media-body">
                                <div class="media-heading">
                                    <div><?= $position->product->category->name_short; ?></div>
                                    <a href="<?= $productUrl; ?>"><?= CHtml::encode($position->product->name); ?></a>
                                </div>
                                <?php foreach ($position->variantsArray as $variant) : ?>
                                    <h6><?= $variant['attribute_title']; ?>: <?= $variant['optionValue']; ?></h6>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                    <div class="pay-box__price">
                        <strong>
                            <span class=""><?= $position->price; ?></span>
                            <?= Yii::t("OrderModule.order", Yii::app()->getModule('store')->currency); ?>
                            ×
                            <?= $position->quantity; ?> <?= Yii::t("OrderModule.order", "PCs"); ?>
                        </strong>
                    </div>
                    <div class="pay-box__totalPrice">
                        <strong>
                            <span><?= $position->getTotalPrice(); ?></span> <?= Yii::t("OrderModule.order", Yii::app()->getModule('store')->currency); ?>
                        </strong>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="pay-bottom">
            <div class="pay-bottom__items">
                <div class="pay-bottom__left">
                    <?= Yii::t("OrderModule.order", "Total"); ?>:
                </div>
                <div class="pay-bottom__right">
                    <?= $model->getTotalPrice(); ?><span class="ruble"> <?= Yii::t("OrderModule.order", Yii::app()->getModule('store')->currency); ?></span>
                </div>
            </div>
            <div class="pay-bottom__items">
                <div class="pay-bottom__left">
                    <?= Yii::t("OrderModule.order", "Delivery price"); ?>:
                </div>
                <div class="pay-bottom__right">
                    <?= $model->getDeliveryPrice();?><span class="ruble"> <?= Yii::t("OrderModule.order", Yii::app()->getModule('store')->currency); ?></span>
                </div>
            </div>
            <div class="pay-bottom__items">
                <div class="pay-bottom__left">
                    <?= Yii::t("OrderModule.order", "Total"); ?>:
                </div>
                <div class="pay-bottom__right">
                    <?= $model->getTotalPriceWithDelivery(); ?><span class="ruble"> <?= Yii::t("OrderModule.order", Yii::app()->getModule('store')->currency); ?></span>
                </div>
            </div>
        </div>
        <?php if (!$model->isPaid() && !$model->isPaymentMethodSelected() && !empty($model->delivery) && $model->delivery->hasPaymentMethods()) : ?>
            <div class="pay-payments">
                <div class="pay-payments__header">
                    Способы оплаты:
                </div>
                <ul id="payment-methods">
                    <?php foreach ((array)$model->delivery->paymentMethods as $payment) : ?>
                        <li class="payment-method">
                            <div class="rich-radio">
                                <input class="payment-method-radio" type="radio" name="payment_method_id"
                                       value="<?= $payment->id; ?>" checked=""
                                       id="payment-<?= $payment->id; ?>">
                                <label for="payment-<?= $payment->id; ?>">
                                    <?= CHtml::encode($payment->name); ?>
                                </label>
                                <?php if($payment->description) : ?>
                                    <div class="description">
                                        <?= $payment->description; ?>
                                    </div>
                                <?php endif; ?>
                                <div class="payment-form hidden">
                                    <?= $payment->getPaymentForm($model); ?>
                                </div>
                            </div>
                        </li>
                    <?php endforeach; ?>
                </ul>
                <div class="text-right pay-payments__button">
                    <button type="submit" class="btn but but-pink" id="start-payment">
                        <?= Yii::t("OrderModule.order", "Pay"); ?>
                        <!-- <span class="glyphicon glyphicon-play"></span> -->
                    </button>
                </div>
            </div>
        <?php else : ?>
           <div class="pay-payments">
                <p class="text-right pay-payments__button">
                    <span class="aler alert-warning" style="display: inline-block; padding: 10px;">
                        <?= $model->getPaidStatus(); ?>
                        <?= CHtml::encode($model->payment->name);?>
                    </span>
                </p>
            </div>
        <?php endif; ?>
    </div>
</div>
