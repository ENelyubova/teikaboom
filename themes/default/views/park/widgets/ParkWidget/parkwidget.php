<?php if ($dataProvider->itemCount): ?>
    <div class="park-list fl fl-di-c">
        <?php foreach ($dataProvider->getData() as $key => $data) : ?>
            <?php $this->render('../../park/_item', ['data' => $data]) ?>
        <?php endforeach; ?>
    </div>
<?php endif; ?>