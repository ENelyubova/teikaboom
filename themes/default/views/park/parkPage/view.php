<?php
/**
 * Шаблон вывода страницы парка ()
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