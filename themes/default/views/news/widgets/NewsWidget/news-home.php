<?php if($models) : ?>
    <div class="news-home section-home">
        <div class="content">
            <div class="box-style box-style-but">
                <div class="box-style__header fl fl-wr-w fl-al-it-c">
                    <div class="box-style__heading">
                        <?= $category->name_short; ?>
                    </div>
                    <div class="box-style__but">
                        <a class="but but-30 but-gray but-svg but-svg-right" href="<?= Yii::app()->createUrl('/news/news/index'); ?>">
                            <span>Все новости</span>
                            <?= CHtml::image(Yii::app()->getTheme()->getAssetsUrl() . '/images/svg/icon-but-arrow.svg', '', ['class' => 'icon-but-arrow']); ?>
                        </a>
                    </div>
                </div>
            </div>
            <div class="news-box news-box-carousel slick-slider">
                <?php foreach ($models as $key => $data) : ?>
                    <div class="slick-item">
                        <?php $this->render('../../news/_item', ['data' => $data]); ?>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
<?php endif; ?>