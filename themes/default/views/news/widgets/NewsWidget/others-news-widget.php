<?php if($models) : ?>
    <div class="news-view-sidebar__header">
        Читайте также
    </div>
    <div class="news-box others-news-box carousel-arrow-circle carousel-arrow-circle-white fl fl-di-c">
        <?php foreach ($models as $key => $data) : ?>
            <?php $this->render('../../news/_item', ['data' => $data]); ?>
        <?php endforeach; ?>
    </div>
<?php endif; ?>