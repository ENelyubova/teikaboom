<?php if($parks) : ?>
    <div class="park-filter-list fl fl-wr-w">
        <div class="park-filter-list__item js-park-item <?= !isset($_GET['park_id']) ? 'active': ''; ?>">
            <a class="park-filter-list__link jsfilter-park-news fl fl-al-it-c" data-id="0" href="#">Все парки</a>
        </div>
        <?php foreach ($parks as $key => $data) : ?>
            <div class="park-filter-list__item js-park-item <?= (isset($_GET['park_id']) &&  $_GET['park_id'] == $data->id) ? 'active': ''; ?>">
                <a class="park-filter-list__link jsfilter-park-news fl fl-al-it-c" data-id="<?= $data->id; ?>" href="#"><?= $data->name_short; ?></a>
            </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>