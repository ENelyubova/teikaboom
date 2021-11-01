<?php

/**
 * ShowMorePager
 */
class ShowMorePager extends CLinkPager
{
    public $buttonText = 'Показать еще';
    public $htmlOptions = [];
    public $wrapTag = null;
    public $isNews = false;
    public $wrapOptions = [];

    public $isVisible = true;

    public function run()
    {
        $this->registerClientScript();

        list ($beginPage, $endPage) = $this->getPageRange();

        $currentPage = $this->getCurrentPage(false);

        if ($endPage <= 0) {
            return ;
        }

        $nextPage = $currentPage + 1;

        if ($nextPage <= $endPage) {
            if ($this->wrapTag) {
                echo CHtml::openTag($this->wrapTag, $this->wrapOptions);
            }
            if($currentPage > 0){
                $offset = $nextPage*$this->getPageSize() + 1;
                if($this->getItemCount() == $offset){
                    $this->htmlOptions['style'] = 'display: none;';
                }
            }
            
            echo CHtml::link('<span>' . $this->buttonText . '</span>' . file_get_contents('.'. Yii::app()->getTheme()->getAssetsUrl() . '/images/icon/icon-up.svg'), $this->createPageUrl($nextPage), $this->htmlOptions);
            if ($this->wrapTag) {
                echo CHtml::closeTag($this->wrapTag);
            }
        }

        return ;
    }
}
