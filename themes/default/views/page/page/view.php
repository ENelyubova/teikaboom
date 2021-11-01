<?php
/* @var $model Page */
/* @var $this PageController */

if ($model->layout) {
    $this->layout = "//layouts/{$model->layout}";
}

$this->title = $model->meta_title ?: $model->title;
$this->breadcrumbs = $this->getBreadCrumbs();
$this->description = $model->meta_description ?: Yii::app()->getModule('yupe')->siteDescription;
$this->keywords = $model->meta_keywords ?: Yii::app()->getModule('yupe')->siteKeyWords;
?>

<?php if($this->webp_support) : ?>
    <?php $backHeader = $model->getImageUrlWebp(0, 0, true, null, 'image'); ?>
<?php else : ?>
    <?php $backHeader = $model->getImageNewUrl(0, 0, true, null, 'image'); ?>
<?php endif; ?>


<div class="page-header-main vacancy-header-main" style="<?= $model->image ? 'background: url('.$backHeader.') no-repeat;': ''?>">
    <div class="content">
        <?php $this->widget('application.components.MyTbBreadcrumbs', [
            'links' => $this->breadcrumbs,
        ]); ?>
        <h1 class="color-white"><?= $model->getTitle(); ?></h1>
        <div class="page-header-main__desc color-white">
            <?= $model->body_short; ?>
        </div>
    </div>
</div>

<div class="page-content">
    <div class="content">
        <div class="back-white-content">
            <?= $model->body; ?>
        </div>
    </div>
</div>