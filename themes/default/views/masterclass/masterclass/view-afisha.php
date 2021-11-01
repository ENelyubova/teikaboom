<?php
/**
 * Отображение для ./themes/default/views/masterclass/masterclass/view-afisha.php:
 *
 * @category YupeView
 * @package  YupeCMS
 * @author   Yupe Team <team@yupe.ru>
 * @license  https://github.com/yupe/yupe/blob/master/LICENSE BSD
 * @link     https://yupe.ru
 *
 * @var $this MasterclassController
 * @var $model Masterclass
 **/
?>
<?php
$this->title = $modelPage->meta_title ?: $modelPage->title_short;
$this->description = $modelPage->meta_description;
$this->keywords = $modelPage->meta_keywords;

$this->breadcrumbs = [
    strip_tags($modelPage->title_short)
];

?>

<?php if($this->webp_support) : ?>
    <?php $backHeader = $modelPage->getImageUrlWebp(0, 0, true, null, 'image'); ?>
<?php else : ?>
    <?php $backHeader = $modelPage->getImageNewUrl(0, 0, true, null, 'image'); ?>
<?php endif; ?>

<div class="page-header-main afisha-header-main" style="<?= $modelPage->image ? 'background: url('.$backHeader.') no-repeat;': ''?>">
    <div class="content fl fl-wr-w">
        <div class="page-header-main__info">
            <?php $this->widget( 'application.components.MyTbBreadcrumbs', [
                'links' => $this->breadcrumbs,
            ]);?>
            <h1 class="color-white m-b-12"><?= $modelPage->getTitle(); ?></h1>
            <div class="page-header-main__desc color-white">
                <?= $modelPage->body_short; ?>
            </div>
        </div>
        <div class="page-header-main__img">
            <picture>
                <source media="(min-width: 1px)" srcset="<?= $modelPage->getImageUrlWebp(0, 0, true, null, 'icon', Yii::app()->getModule('page')->uploadPath2); ?>" type="image/webp">
                <source media="(min-width: 1px)" srcset="<?= $modelPage->getImageNewUrl(0, 0, true, null, 'icon', Yii::app()->getModule('page')->uploadPath2); ?>">
                
                <img src="<?= $modelPage->getImageNewUrl(0, 0, true, null, 'icon', Yii::app()->getModule('page')->uploadPath2); ?>" alt="">
            </picture>
        </div>
    </div>
</div>

<div class="page-content">
    <div class="content">
        <div class="back-white-content">
            <?php $this->widget( 'application.modules.masterclass.widgets.FullcalendarWidget', [
                'id' => 'calendar-dates',
                'events' => empty( $poster ) ? [] : $poster,
                'clientOptions' => [
                    'allDaySlot' => true,
                    'header' => [
                        'center' => 'title',
                        'left' => 'prev, next today',
                        'right' => 'dayGridMonth',
                    ],
                    'longPressDelay' => 100,
                    'editable' => false,
                    'eventLimit' => true,
                    'eventContent' => 'js:function(arg){

                        arg.view.calendar.el.querySelector(`td[data-date="${arg.event.startStr}"]`).classList.add("fc-day-events");

                        let element = document.createElement("div")
                        
                        if(arg.event.extendedProps.description != ""){
                           element.innerHTML = arg.event.extendedProps.description; 
                        }
                        else{
                            element.innerHTML = arg.event.title;
                        }

                        let arrayOfDomNodes = [ element ]
                        return { domNodes: arrayOfDomNodes }
                    }',
                    'eventClick' =>  'js:function(info) {
                        let widthDoc = $( window ).width();
                        info.jsEvent.preventDefault();
                        
                        if (info.event.url && widthDoc < 1000) {
                            $(".preloader").addClass("active");

                            $.ajax({
                                url: info.event.url,
                                dataType: "html",
                                data:{
                                    date: info.event.startStr
                                }
                            }).done(function(response){
                                $(".preloader").removeClass("active");
                                $("#eventsModal .modal-content").html(response);
                                $("#eventsModal").modal("show");
                            });
                        }else{
                            window.open(info.event.url);
                        }
                    }'
                ]
            ]); ?>
        </div>
    </div>
</div>

<?php /* Блок остались вопросы */?>
<?php $this->widget('application.modules.contentblock.widgets.ContentMyBlockWidget', [
    'id' => 1,
    'view' => 'stillQuestions-box'
]); ?>

<div id="eventsModal" class="modal modal-my modal-my-xs fade" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        </div>
    </div>
</div>