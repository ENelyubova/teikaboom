<?php if ($dataProvider->itemCount): ?>
    <ul class="menu-footer">
        <?php foreach ($dataProvider->getData() as $key => $data) : ?>
            <li>
                <a href="<?= Yii::app()->createUrl('/park/park/view', ['slug' => $data->slug]); ?>"><?= $data->name_short; ?></a>
            </li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>