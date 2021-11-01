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


<div class="page-header-main contact-header-main" style="<?= $model->image ? 'background: url('.$backHeader.') no-repeat;': ''?>">
    <div class="content">
        <?php $this->widget('application.components.MyTbBreadcrumbs', [
            'links' => $this->breadcrumbs,
        ]); ?>
        <h1 class="color-white"><?= $model->getTitle(); ?></h1>
        <div class="page-header-main__desc color-white">
            <div class="park-filter-list fl fl-wr-w">
                <?php foreach ($model->getAttributeGroup(1) as $key => $data) : ?>
                    <div class="park-filter-list__item">
                        <a class="park-filter-list__link js-contact-item-scrolling fl fl-al-it-c" href="#contact-collapse-item-<?= $key; ?>"><?= $data['name']; ?></a>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>

<div class="page-content">
    <div class="content">
        <?php //= $model->body; ?>
        <div class="contact-collapse">
            <?php foreach ($model->getAttributeGroup(1) as $key => $data) : ?>
                <div class="contact-collapse__item contact-collapse__item_<?= $key; ?>" id="contact-collapse-item-<?= $key; ?>">
                    <div class="contact-collapse__content back-white-content">
                        <div class="contact-collapse__header contact-collapse-header fl fl-al-it-c">
                            <div class="contact-collapse-header__img">
                                <picture>
                                    <source media="(min-width: 1px)" srcset="<?= $model->geFieldImageWebp(0, 0, false, $data['image']); ?>" type="image/webp">
                                    <source media="(min-width: 1px)" srcset="<?= $model->getFieldImageUrl(0, 0, false, $data['image']); ?>">

                                    <img src="<?= $model->getFieldImageUrl(0, 0, false,  $data['image']); ?>" alt="">
                                </picture>
                            </div>
                            <div class="contact-collapse-header__name h1Home-style">
                                <?= $data['name']; ?>
                            </div>
                        </div>
                        <div class="contact-collapse__body">
                        <?= $data['value']; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
	</div>
</div>

<?php /* Блок остались вопросы */?>
<?php $this->widget('application.modules.contentblock.widgets.ContentMyBlockWidget', [
    'id' => 1,
    'view' => 'stillQuestions-box'
]); ?>