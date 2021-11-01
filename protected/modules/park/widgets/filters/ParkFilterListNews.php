<?php

/**
 * Class ParkFilterListNews
 */
class ParkFilterListNews extends \yupe\widgets\YWidget
{
    /**
     * @var string
     */
    public $view = 'park-list-filter';

    /**
     * @throws CException
     */
    public function run()
    {
        $parks = Park::model()->published()->findAll();

        $this->render($this->view, ['parks' => $parks]);
    }
} 
