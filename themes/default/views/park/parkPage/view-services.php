<?php
/**
 * Шаблон вывода страницы парка (Услуги)
 *
 * @var $this ParkPageController
 * @var $model ParkPage
 **/


$this->title = $modelPage->meta_title ?: $modelPage->name;
// $this->breadcrumbs = $this->getBreadCrumbs();
$this->description = $modelPage->meta_description ?: Yii::app()->getModule('yupe')->siteDescription;
$this->keywords = $modelPage->meta_keywords ?: Yii::app()->getModule('yupe')->siteKeyWords;
?>

<?php // Шапка для парка и навигация ?>
<?php $this->renderPartial('//park/park/_view-header', ['model' => $modelPark]); ?>

<div class="page-content parkView-content">
    <div class="content">
        
    </div>
</div>

<?php /* Блок остались вопросы */?>
<?php $this->widget('application.modules.contentblock.widgets.ContentMyBlockWidget', [
    'id' => 1,
    'view' => 'stillQuestions-box'
]); ?>