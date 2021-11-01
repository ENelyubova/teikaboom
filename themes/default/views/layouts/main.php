<!DOCTYPE html>
<html lang="<?= Yii::app()->language; ?>">
<head>
    <?php \yupe\components\TemplateEvent::fire(DefautThemeEvents::HEAD_START);?>
    
    <link rel="preconnect" href="https://mc.yandex.ru" />
    <link rel="preconnect" href="https://connect.facebook.net" />
    <link rel="preconnect" href="https://www.googletagmanager.com" />
    <link rel="preconnect" href="https://www.googleadservices.com" />
    <link rel="preconnect" href="https://www.google-analytics.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" />
    <link rel="preconnect" href="https://www.gstatic.com" />
    <link rel="preconnect" href="https://www.google.com" />
    <link rel="preconnect" href="https://stackpath.bootstrapcdn.com" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />

    <!-- <link rel="apple-touch-icon" sizes="57x57" href="<?= $this->mainAssets; ?>/images/favicon/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="<?= $this->mainAssets; ?>/images/favicon/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="<?= $this->mainAssets; ?>/images/favicon/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="<?= $this->mainAssets; ?>/images/favicon/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="<?= $this->mainAssets; ?>/images/favicon/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="<?= $this->mainAssets; ?>/images/favicon/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="<?= $this->mainAssets; ?>/images/favicon/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="<?= $this->mainAssets; ?>/images/favicon/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="<?= $this->mainAssets; ?>/images/favicon/apple-icon-180x180.png">

    <link rel="icon" type="image/png" sizes="16x16" href="<?= $this->mainAssets; ?>/images/favicon/favicon-16x16.png">
    <link rel="icon" type="image/png" sizes="32x32" href="<?= $this->mainAssets; ?>/images/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="<?= $this->mainAssets; ?>/images/favicon/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="192x192"  href="<?= $this->mainAssets; ?>/images/favicon/android-icon-192x192.png"> -->

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta http-equiv="Content-Language" content="ru-RU" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <title><?= $this->title;?></title>
    <meta name="description" content="<?= $this->description;?>" />
    <meta name="keywords" content="<?= $this->keywords;?>" />

    <?php if ($this->canonical): ?>
        <link rel="canonical" href="<?= $this->canonical ?>" />
    <?php else : ?>
        <link rel="canonical" href="<?= Yii::app()->request->hostInfo . '/' . Yii::app()->request->pathInfo; ?>">
    <?php endif; ?>

    <?php
    
    if(Yii::app()->request->queryString) {
        Yii::app()->clientScript->registerMetaTag('noindex, nofollow', 'robots');
    } else {
        Yii::app()->clientScript->registerMetaTag('noindex, nofollow', 'robots');
    }
    
    $indexCss = $this->mainAssets . "/css/index.css";
    $indexCss = $indexCss . "?v-" . filectime(Yii::getPathOfAlias('public') . $indexCss);
    Yii::app()->getClientScript()->registerCssFile($indexCss);

    $mainJs = $this->mainAssets . "/js/main.js";
    $mainJs = $mainJs . "?v-" . filectime(Yii::getPathOfAlias('public') . $mainJs);
    Yii::app()->getClientScript()->registerScriptFile($mainJs, CClientScript::POS_END);

    Yii::app()->getClientScript()->registerScriptFile($this->mainAssets . '/js/modernizr-custom.js', CClientScript::POS_END);
    
    Yii::app()->clientScript->registerMetaTag('telephone=no', 'format-detection');

    /* 
     * Шрифты 
    */
    Yii::app()->getClientScript()->registerLinkTag('preload stylesheet', 'text/css', 'https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css', NULL, ['as'=> 'style']);
    Yii::app()->getClientScript()->registerLinkTag('preload stylesheet', 'text/css', 'https://fonts.googleapis.com/css?family=Roboto+Condensed:300,400,700&display=swap&subset=cyrillic,cyrillic-ext,latin-ext', NULL, ['as'=> 'style']);

    ?>
    <script type="text/javascript">
        var yupeTokenName = "<?= Yii::app()->getRequest()->csrfTokenName;?>";
        var yupeToken = "<?= Yii::app()->getRequest()->getCsrfToken();?>";
        var yupeCartDeleteProductUrl = "<?= Yii::app()->createUrl('/cart/cart/delete/')?>";
        var yupeCartUpdateUrl = "<?= Yii::app()->createUrl('/cart/cart/update/')?>";
        var yupeCartWidgetUrl = "<?= Yii::app()->createUrl('/cart/cart/widget/')?>";
        var phoneMaskTemplate = "<?= Yii::app()->getModule('user')->phoneMask; ?>";
    </script>

    <?php $this->widget('application.modules.contentblock.widgets.ContentMyBlockWidget', [
        'id' => 5
    ]); ?>


    <!--[if IE]>
    <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <!-- <link rel="stylesheet" href="http://yandex.st/highlightjs/8.2/styles/github.min.css">
    <script src="http://yastatic.net/highlightjs/8.2/highlight.min.js"></script> -->
    <?php \yupe\components\TemplateEvent::fire(DefautThemeEvents::HEAD_END);?>
</head>

<body class="<?= ($this->action->id=='index' && $this->id=='hp') ? 'body-home' : 'body-page'; ?> <?= $this->bodyClass; ?>">

<?php \yupe\components\TemplateEvent::fire(DefautThemeEvents::BODY_START);?>

<div class="wrapper">
    <div class="wrap1">
        
        <?php $this->renderPartial('//layouts/_header'); ?>

        <?= $this->decodeWidgets($content); ?>
    </div>
    <div class="wrap2">
        <?php $this->renderPartial('//layouts/_footer'); ?>
    </div>
</div>

<div class="mobileNav">
    <div class="mobileNav__icon-close mobile-icon-close"><div></div></div>
    <div class="mobileNav-box">
        <div class="mobileNav-header">
            <div class="mobileNav-header__logo">
                <?= CHtml::image($this->mainAssets . '/images/logo.svg', ''); ?>
            </div>
            <div class="mobileNav-header__contact header-contact fl fl-al-it-c">
                <div class="header-contact__item header-contact__phone">
                    <?php $this->widget('application.modules.dictionary.widgets.DictionaryDataWidget', ['id' => 1, 'view' => 'dictionary-phone']); ?>
                </div>
                <div class="header-contact__item header-contact__email">
                    <?php $this->widget('application.modules.dictionary.widgets.DictionaryDataWidget', ['id' => 2, 'view' => 'dictionary-email']); ?>
                </div>
            </div>
        </div>
        <div class="mobileNav-box-2">
            <ul class="menu-mobile">
            </ul>
            <div class="mobileNav-box-but header-btn fl fl-di-c fl-al-it-c">
                <div class="header-btn__item">
                    <a class="header-btn__link but but-yellow but-animate-transform" href="#">
                        <?php $this->widget('application.modules.dictionary.widgets.DictionaryDataWidget', ['id' => 3]); ?>
                    </a>
                </div>
                <div class="header-btn__item">
                    <a class="header-btn__link but but-pink but-animate-transform" data-toggle="modal" data-target="#orderHolidayModal" href="#">
                        <?php $this->widget('application.modules.dictionary.widgets.DictionaryDataWidget', ['id' => 4]); ?>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="menuModal" class="menuModal modal modal-my modal-my-xs fade" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content menuModal-box fl fl-ju-co-sp-b">
            <div class="menuModal-box__img box-style-img">
                <?php $this->widget('application.modules.contentblock.widgets.ContentMyBlockWidget', [
                    'id' => 7, 
                    'view' => 'contentblock-img'
                ]); ?>
            </div>
            <div class="menuModal-box__content">
                <div class="menuModal-box__header menuModal-header fl fl-al-it-c fl-ju-co-sp-b">
                    <div class="menuModal-header__logo">
                        <?= CHtml::image($this->mainAssets . '/images/logo.svg', ''); ?>
                    </div>
                    <div class="menuModal-header__but header-btn fl fl-al-it-c">
                        <div class="header-btn__item">
                            <a class="header-btn__link but but-yellow but-animate-transform" href="#">
                                <?php $this->widget('application.modules.dictionary.widgets.DictionaryDataWidget', ['id' => 3]); ?>
                            </a>
                        </div>
                        <div class="header-btn__item">
                            <a class="header-btn__link but but-pink but-animate-transform" data-toggle="modal" data-target="#orderHolidayModal" href="#">
                                <?php $this->widget('application.modules.dictionary.widgets.DictionaryDataWidget', ['id' => 4]); ?>
                            </a>
                        </div>
                    </div>
                    <div class="menuModal-header__close menuModal__icon-close mobile-icon-close" data-dismiss="modal"><div></div></div>
                </div>
                <div class="menuModal-box__body menuModal-body fl fl-wr-w">
                    <div class="menuModal-body__item">
                        <ul class="js-load-menu-home"></ul>
                    </div>
                    <div class="menuModal-body__item">
                        <ul class="js-load-menu-company"></ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $fancybox = $this->widget(
    'gallery.extensions.fancybox3.AlFancybox', [
        'target' => '[data-fancybox]',
        'lang'   => 'ru',
        'config' => [
            'animationEffect' => "fade",
            'buttons' => [
                "zoom",
                "close",
            ]
        ],
    ]
); ?>

<div id="messageModal" class="modal modal-my modal-my-xs fade" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header box-style">
                <div data-dismiss="modal" class="modal-close"><div></div></div>
                <div class="box-style__header">
                    <div class="box-style__heading">
                        Уведомление
                    </div>
                </div>
            </div>
            <div class="modal-body">
                <div class="message-success">
                    Ваша заявка успешно отправлена!
                </div>
            </div>
        </div>
    </div>
</div>

<?php //Модалка для поиска ?>
<?php /*$this->widget('application.modules.store.widgets.SearchProductWidget', [
    'view' => 'search-product-form-modal'
]);*/ ?>

 <!-- Заказать праздник -->
<?php $this->widget('application.modules.mail.widgets.GeneralFeedbackWidget', [
    'id' => 'orderHolidayModal',
    'formClassName' => 'StandartForm',
    'buttonModal' => false,
    'titleModal' => 'Заказать праздник',
    'showCloseButton' => false,
    'isRefresh' => true,
    'eventCode' => 'zakazat-zvonok',
    'successKey' => 'zakazat-zvonok',
    'modalHtmlOptions' => [
        'class' => 'modal-my',
    ],
    'formOptions' => [
        'htmlOptions' => [
            'class' => 'form-my',
        ]
    ],
    'modelAttributes' => [
        'theme' => 'Заказать праздник',
    ],
]) ?>
 <!-- Остались вопросы -->
<?php $this->widget('application.modules.mail.widgets.GeneralFeedbackWidget', [
    'id' => 'stillQuestionsModal',
    'formClassName' => 'StandartForm',
    'buttonModal' => false,
    'titleModal' => 'Остались вопросы',
    'showCloseButton' => false,
    'isRefresh' => true,
    'eventCode' => 'zakazat-zvonok',
    'successKey' => 'zakazat-zvonok',
    'modalHtmlOptions' => [
        'class' => 'modal-my',
    ],
    'formOptions' => [
        'htmlOptions' => [
            'class' => 'form-my',
        ]
    ],
    'modelAttributes' => [
        'theme' => 'Остались вопросы',
    ],
]) ?>


<?php $this->widget('application.modules.contentblock.widgets.ContentMyBlockWidget', [
    'id' => 6
]); ?>

<?php Yii::app()->getClientScript()->registerScript("js-aos-init", "
    AOS.init();
"); ?>

<?php \yupe\components\TemplateEvent::fire(DefautThemeEvents::BODY_END);?>

<div class='notifications top-right' id="notifications"></div>
<div class="ajax-loading"></div>

<div class="preloader">
    <div class="lds-spinner"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>
</div>

</body>
</html>
