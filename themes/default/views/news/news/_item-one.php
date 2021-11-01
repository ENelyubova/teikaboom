<?php if($index == 0): ?>
    <div class="news-box-one fl fl-wr-w">
        <div class="news-box-one__item news-box-one__item_0">
<?php elseif($index == 1): ?>
        <div class="news-box-one__item news-box-one__item_1 fl fl-wr-w">
<?php endif; ?>

    <?php if(get_class($this) == 'NewsHomeWidget') : ?>
        <?php $this->render('../../news/_item', ['data' => $data]); ?>
    <?php else : ?>
        <?php $this->renderPartial('//news/news/_item', ['data' => $data]); ?>
    <?php endif; ?>
    
<?php if($index == 0 || $index == 4): ?>
    </div>
<?php endif; ?>

<?php if($index == 4): ?>
    </div>
<?php endif; ?>