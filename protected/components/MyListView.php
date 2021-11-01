<?php
Yii::import('bootstrap.widgets.TbListView');
/**
 * MyListView
 */
class MyListView extends TbListView
{
    public function renderControls()
    {
        echo '
            <div class="catalog-controls fl fl-wr-w fl-al-it-c fl-ju-co-fl-e">
                <div class="catalog-controls__summary"> ';
                    $this->renderSummary();
        echo '</div>
                <div class="catalog-controls__res fl fl-wr-w fl-al-it-c fl-ju-co-fl-e">
                    ' . $this->countPage() . '
                    <div class="template-product fl fl-al-it-c fl-ju-co-fl-e">
                        <div data-view="_item-list" class="template-product__item template-product__list '.($this->controller->storeItem == "_item-list" ? "active" : "" ).'">'. file_get_contents('.'. Yii::app()->getTheme()->getAssetsUrl() . '/images/svg/product-list.svg') .'</div>
                        <div data-view="_item" class="template-product__item template-product__grid '.($this->controller->storeItem == "_item" ? "active" : "" ).'">'. file_get_contents('.'. Yii::app()->getTheme()->getAssetsUrl() . '/images/svg/product-grid.svg') .'</div>
                    </div>
                </div>
            </div>';
    }

    public function renderCountPage()
    {
        echo $this->countPage();
    }

    public function countPage()
    {
        $pageList = [20, 40, 80, 100];
        // $pageList = [2, 4, 8, 10];
        $pageL = "<div class='countItem-box filter-inline fl fl-al-it-c fl-ju-co-fl-e'>
            <div class='filter-inline__header fl fl-ju-co-sp-b'>Показывать по: </div>
            <div class='filter-inline__body countItem-wrapper box-wrapper fl'>
            <div class='countItem-wrapper__header box-wrapper__header fl fl-al-it-c'>{$this->controller->storeCountPage}</div>
                <div class='countItem-wrapper__body box-wrapper__body'>";

        foreach ($pageList as $key => $data) {
            $pageL .= "<div class='countItem-wrapper__link box-wrapper__link " . (($data == $this->controller->storeCountPage) ? 'active' : '') . "' data-count='{$data}'>{$data}</div>";
        }
        $pageL .= "</div></div></div>";

        return $pageL;
    }

    /**
     * Renders the sorter.
     */
    public function renderSorter()
    {
        if($this->dataProvider->getItemCount()<=0 || !$this->enableSorting || empty($this->sortableAttributes))
            return;
        echo CHtml::openTag('div',array('class'=>$this->sorterCssClass))."\n";
        echo $this->sorterHeader===null ? Yii::t('zii','Sort by: ') : $this->sorterHeader;
        echo "<ul>\n";
        $sort=$this->dataProvider->getSort();
        foreach($this->sortableAttributes as $name=>$label)
        {
            echo "<li>";
            if(is_integer($name))
                echo $sort->link($label);
            else
                echo $sort->link($name,$label);
            echo "</li>\n";
        }
        echo "</ul>";
        echo $this->sorterFooter;
        echo CHtml::closeTag('div');
    }

    /**
     * Renders the summary text.
     */
    public function renderSummary()
    {
        if(($count=$this->dataProvider->getItemCount())<=0)
            return;

        echo CHtml::openTag($this->summaryTagName, array('class'=>$this->summaryCssClass));
        if($this->enablePagination)
        {
            $pagination=$this->dataProvider->getPagination();
            $total=$this->dataProvider->getTotalItemCount();
            $start=$pagination->currentPage*$pagination->pageSize+1;
            $end=$start+$count-1;
            if($end>$total)
            {
                $end=$total;
                $start=$end-$count+1;
            }
            if(($summaryText=$this->summaryText)===null)
                $summaryText=Yii::t('zii','Displaying {start}-{end} of 1 result.|Displaying {start}-{end} of {count} results.',$total);
            echo strtr($summaryText,array(
                '{start}'=>$start,
                '{end}'=>$end,
                '{count}'=>$total,
                '{page}'=>$pagination->currentPage+1,
                '{pages}'=>$pagination->pageCount,
            ));
        }
        else
        {
            if(($summaryText=$this->summaryText)===null)
                $summaryText=Yii::t('zii','Total 1 result.|Total {count} results.',$count);
            echo strtr($summaryText,array(
                '{count}'=>$count,
                '{start}'=>1,
                '{end}'=>$count,
                '{page}'=>1,
                '{pages}'=>1,
            ));
        }
        echo CHtml::closeTag($this->summaryTagName);
    }
}
