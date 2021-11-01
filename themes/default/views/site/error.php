<?php $this->title = Yii::t('default', 'Error') . ' ' . $error['code']; ?>
<?php $this->breadcrumbs = [Yii::t('default', 'Error') . ' ' . $error['code']]; ?>
<?php //$this->bodyClass = 'body-error'; ?>
<?php //$this->footerClass = 'hidden'; ?>

<?php 
     $eyeJs = $this->mainAssets . "/js/eye.js";
     $eyeJs = $eyeJs . "?v-" . filectime(Yii::getPathOfAlias('public') . $eyeJs);
     Yii::app()->getClientScript()->registerScriptFile($eyeJs, CClientScript::POS_END);
?>

<div class="page-content">
    <div class="content">
        <div class="back-white-content">
            <p>Страница находится в разработке</p>
            <ul>
                <li><a href="https://afisha.teikaboom.ru/" target="_blank">Купить билет</a></li>
                <li><a href="/konditerka">Кондитерка</a></li>
                <li><a href="/restoran">Кафе и рестораны</a></li>
            </ul>
        </div>
        <?php /* ?>
        <div class="error-content">
            <div class="error-content__txt">
                <h1 class="center color-white"><?= ($error['code'] == '404') ? 'Извините, запрашиваемая <br>страница не найдена' : $this->title; ?></h1>

                <?php switch ($error['code']) {
                    case '404':
                        $msg = "Возможно она была удалена или даже никогда <br>не существовала. Чтобы найти нужную информацию, <br>рекомендуем перейти на главную страницу";
                        break;
                    default:
                        $msg = $error['message'];
                        break;
                } ?>
                <div class="error-content__desc t-stl center color-white">
                    <p><?= $msg; ?></p>
                    <div class="error-content__but fl fl-ju-co-c">
                        <a class="but but-pink but-animation" href="/">На главную</a>
                    </div>
                </div>
            </div>
            <div class="error-content__media">
                <div class="error-anim">
                    <div class="error-anim__img">
                        <picture class="fl fl-ju-co-c">
                            <source media="(min-width: 1241px)" srcset="<?= Yii::app()->getTheme()->getAssetsUrl() . '/images/404.webp'; ?>" type="image/webp">
                            <source media="(min-width: 1241px)" srcset="<?= Yii::app()->getTheme()->getAssetsUrl() . '/images/404.png'; ?>">
                            
                            <source media="(min-width: 481px)" srcset="<?= Yii::app()->getTheme()->getAssetsUrl() . '/images/404-sm.webp'; ?>" type="image/webp">
                            <source media="(min-width: 481px)" srcset="<?= Yii::app()->getTheme()->getAssetsUrl() . '/images/404-sm.png'; ?>">
                            
                            <source media="(min-width: 1px)" srcset="<?= Yii::app()->getTheme()->getAssetsUrl() . '/images/404-xs.webp'; ?>" type="image/webp">
                            <source media="(min-width: 1px)" srcset="<?= Yii::app()->getTheme()->getAssetsUrl() . '/images/404-xs.png'; ?>">
        
                            <img src="<?= Yii::app()->getTheme()->getAssetsUrl() . '/images/404.png'; ?>" alt="">
                        </picture>
                    </div>
                    <div class="eye eye-left">
                        <div class="eye-pupil"></div>
                    </div>
                    <div class="eye eye-right">
                        <div class="eye-pupil"></div>
                    </div>
                </div>
            </div>
        </div>
        <?php */ ?>
    </div>
</div>

<style>
    .back-white-content{
        margin-top: 50px;
    }
    .back-white-content a{
        color: #FFB23E;
    }
    @media screen and (min-width: 1001px){
        .back-white-content{
            margin-top: 170px;
        }
    }
</style>