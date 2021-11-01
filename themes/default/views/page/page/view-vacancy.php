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
            <?php //$model->body; ?>
            <div class="js-vacancy-box">
                <script type="text/javascript" class="hh-script" src="https://api.hh.ru/widgets/vacancies/employer?employer_id=4510329&locale=RU&links_color=1560b2&border_color=transparent"></script>
            </div>
        </div>
    </div>
</div>

<?php Yii::app()->getClientScript()->registerScript("js-vacancy-box", "
    var content = $('.js-vacancy-box');
    var msg = '<div class=\"js-msg-addb msg-addblock\"><div class=\"msg-addblock__header\"><strong>Пожалуйста, отключите AddBlock!</strong></div><p>AdBlock мешает корректного отображения списка вакансий.</p><p>Выключите его для полного доступа к информации.</p></div>';
    if(content.height() > 0){
        $('.js-msg-addb').remove();
    } else {
        content.append(msg);
    }
"); ?>
<script>
    
</script>