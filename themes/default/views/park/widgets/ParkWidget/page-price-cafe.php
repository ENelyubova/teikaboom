<?php if ($dataProvider->itemCount): ?>
    <div class="park-block fl fl-wr-w">
        <?php foreach ($dataProvider->getData() as $key => $data) : ?>
            <?php $this->render('../../park/_item-parkCafe', ['data' => $data]) ?>
        <?php endforeach; ?>
    </div>
<?php endif; ?>