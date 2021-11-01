<?php if($models) : ?>
    <div class="others-masterclass-section">
        <div class="content">
            <div class="others-masterclass-section__header">
                <div class="h1Home-style txt-up-none">Другие мастер-классы</div>
            </div>
            <div class="news-box others-masterclass-carousel carousel-arrow-circle carousel-arrow-circle-white slick-slider">
                <?php foreach ($models as $key => $data) : ?>
                    <div class="slick-item">
                        <?php $this->render('../../masterclass/_item', ['data' => $data]); ?>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
<?php endif; ?>
