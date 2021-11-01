<?php if ($dataProvider->itemCount): ?>
    <div class="park-list parl-list_price fl fl-wr-w">
        <?php foreach ($dataProvider->getData() as $key => $data) : ?>
            <?php $this->render('../../park/_item-parkPrice', ['data' => $data]) ?>
        <?php endforeach; ?>
    </div>
<?php endif; ?>