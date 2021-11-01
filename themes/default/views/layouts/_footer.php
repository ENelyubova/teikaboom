<footer class="<?= ($this->action->id=='index' && $this->id=='hp') ? 'footer-home' : 'footer-page'; ?> <?= $this->footerClass; ?>">
    <div class="footer">
        <div class="content">
            <div class="footer__top footer-top fl fl-wr-w fl-ju-co-sp-b">
                <div class="footer-top__logo footer-logo">
                    <a href="/">
                        <?= CHtml::image($this->mainAssets . '/images/logo.svg') ?>
                    </a>
                </div>
                <div class="footer-top__contact footer-contact fl fl-wr-w fl-al-it-c">
                    <div class="footer-contact__item footer-contact__item_0">
                         <div class="footer-contact__phone">
                            <?php $this->widget('application.modules.dictionary.widgets.DictionaryDataWidget', ['id' => 7, 'view' => 'dictionary-phone']); ?>
                        </div>
                        <div class="footer-contact__email">
                            <?php $this->widget('application.modules.dictionary.widgets.DictionaryDataWidget', ['id' => 2, 'view' => 'dictionary-email']); ?>
                        </div>
                    </div>
                    <div class="footer-contact__item footer-contact__item_1">
                        <div class="footer-contact__soc soc-box">
                            <?php $this->widget('application.modules.dictionary.widgets.DictionaryDataWidget', [
                                'group_id' => 3,
                                'viewAll' => 'dictionary-socseti'
                            ]); ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer__bottom footer-bottom fl fl-wr-w fl-ju-co-sp-b">
                <div class="footer-bottom__item footer-bottom__item_0">
                    <div class="footer__heading">Парки</div>
                    <?php $this->widget('application.modules.park.widgets.ParkWidget', [
                        'view' => 'menu-footer'
                    ]); ?>
                    <?php $this->widget('application.modules.menu.widgets.MenuWidget', [
                        'view' => 'footermenu',
                        'name' => 'footer-parks'
                    ]); ?>
                </div>
                <div class="footer-bottom__item footer-bottom__item_1 js-footer-company-menu">
                    <div class="footer__heading">Компания</div>
                    <?php if(Yii::app()->hasModule('menu')): ?>
                        <?php $this->widget('application.modules.menu.widgets.MenuWidget', [
                            'view' => 'footermenu',
                            'name' => 'nizhnee-menyu'
                        ]); ?>
                    <?php endif; ?>
                </div>
                <div class="footer-bottom__item footer-bottom__item_2 footer-menu-md">
                    <?php if(Yii::app()->hasModule('menu')): ?>
                        <?php $this->widget('application.modules.menu.widgets.MenuWidget', [
                            'view' => 'footermenu', 
                            'name' => 'top-menu'
                        ]); ?>
                    <?php endif; ?>
                </div>
                <div class="footer-bottom__item footer-bottom__item_3 footer-menu-md">
                    <div class="footer__dc-logo">
                        <a class="fl fl-wr-w fl-al-it-c" target="_blank" href="https://dcmedia.ru">
                            <span>Создано в</span>
                            <?= CHtml::image(Yii::app()->getTheme()->getAssetsUrl() . '/images/DCMedia-logo.svg');?>
                        </a>
                    </div>
                </div>
            </div>
            <div class="footer__copy footer-copy fl fl-al-it-c">
                &copy; <?= date("Y"); ?> <?php $this->widget('application.modules.contentblock.widgets.ContentMyBlockWidget', ['id' => 2]); ?>
            </div>
        </div>
    </div>
</footer>