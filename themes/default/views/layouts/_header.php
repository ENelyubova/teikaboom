<header class="<?= ($this->action->id=='index' && $this->id=='hp') ? 'header-home' : 'header-page'; ?>">
    <div class="header">
        <div class="content fl fl-al-it-c">
            <div class="header__logo">
                <a href="/">
                    <?= CHtml::image($this->mainAssets . '/images/logo.svg', ''); ?>
                </a>
            </div>
            <div class="header__section header-section fl fl-al-it-c">
                <div class="header-section__mc fl fl-di-c">
                    <div class="header__contact header-contact fl fl-al-it-c">
                        <div class="header-contact__item header-contact__phone">
                            <?php $this->widget('application.modules.dictionary.widgets.DictionaryDataWidget', ['id' => 1, 'view' => 'dictionary-phone']); ?>
                        </div>
                        <div class="header-contact__item header-contact__email">
                            <?php $this->widget('application.modules.dictionary.widgets.DictionaryDataWidget', ['id' => 2, 'view' => 'dictionary-email']); ?>
                        </div>
                    </div>
                    <div class="header__menu header-menu">
                        <?php if(Yii::app()->hasModule('menu')): ?>
                            <?php $this->widget('application.modules.menu.widgets.MenuWidget', [
                                'view' => 'main',
                                'name' => 'top-menu'
                            ]); ?>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="header-section__btn header__btn header-btn fl fl-al-it-c">
                    <div class="header-btn__item">
                        <a class="header-btn__link but but-yellow but-animate-transform" rel="nofollow" target="_blank" href="https://afisha.teikaboom.ru/">
                            <?php $this->widget('application.modules.dictionary.widgets.DictionaryDataWidget', ['id' => 3]); ?>
                        </a>
                    </div>
                    <div class="header-btn__item">
                        <a class="header-btn__link but but-pink but-animate-transform" data-toggle="modal" data-target="#orderHolidayModal" href="#">
                            <?php $this->widget('application.modules.dictionary.widgets.DictionaryDataWidget', ['id' => 4]); ?>
                        </a>
                    </div>
                    <div class="header-btn__item header-btn__menuIcon fl fl-ju-co-c fl-al-it-c">
                        <a class="header-btn__link mobileMenu-icon fl fl-di-c fl-ju-co-c js-menu-mobileNav" href="#">
                            <span class="mobileMenu-icon__item"></span>
                            <span class="mobileMenu-icon__item"></span>
                            <span class="mobileMenu-icon__item"></span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>