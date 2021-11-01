<?php
Yii::import('application.modules.menu.components.YMenu'); ?>
<div class='menu'>
    <?php $this->widget(
         'zii.widgets.CMenu',
         [
             'encodeLabel' => false,
             'items' => $this->params['items'],
             'htmlOptions' => [
                'class' => 'menu-main',
             ],
         ]
     ); ?>
</div>