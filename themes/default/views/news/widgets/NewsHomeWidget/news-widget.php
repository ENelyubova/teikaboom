<?php
    $this->widget(
        // 'application.components.MyListView',
        'application.components.FtListView',
        [
            'dataProvider' => $dataProvider,
            'id' => 'news-box',
            'itemView' => '../../news/'.$itemView,
            'summaryText'=>"{count} тов.",
            'template'=>'
                {items}
                {pager}
            ',
            'itemsCssClass' => 'news-box',
            'htmlOptions' => [
                'class' => 'news-box-listView'
            ],
            'ajaxUpdate'=>true,
            'enableHistory' => true,
            'pagerCssClass' => 'pagination-box',
            'pager' => [
                'class' => 'application.components.ShowMorePager',
                'buttonText' => 'Показать еще',
                'isNews' => true,
                'wrapTag' => 'div',
                'htmlOptions' => [
                    'class' => 'but-link but-link-svg but-link-svg-right fl fl-al-it-c'
                ],
                'wrapOptions' => [
                    'class' => ''
                ],
            ]
        ]
    ); ?>