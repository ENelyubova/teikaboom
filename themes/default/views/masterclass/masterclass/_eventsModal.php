<div class="modal-header box-style">
    <div data-dismiss="modal" class="modal-close"><div></div></div>
    <div class="box-style__header">
        <div class="box-style__heading">
            Мастер-классы <br><?= Yii::app()->dateFormatter->format("dd MMMM yyyyг.", $date);?>
        </div>
    </div>
</div>
<div class="modal-body">
    <ul class="events-list">
        <?php foreach($events as $event):?>
        <li class="events-list__item event-item">
            <a class="event-item__link" href="<?= Yii::app()->createAbsoluteUrl('/masterclass/masterclass/view', ['slug' => $event->slug]); ?>">
                <span class="event-item__name"><?= $event->name_short; ?></span>
                <span class="event-item__park"><?= $event->park->name_short; ?></span>
            </a>
        </li>
        <?php endforeach; ?>
    </ul>    
</div>
