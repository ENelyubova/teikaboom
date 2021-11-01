<?php

/**
 * Class ThemeMasterclassFilterWidget
 */
class ThemeMasterclassFilterWidget extends \yupe\widgets\YWidget
{
    /**
     * @var string
     */
    public $view = 'theme-list-filter';

    /**
     * @throws CException
     */
    public function run()
    {
        $theme = MasterclassTheme::model()->published()->findAll();

        $this->render($this->view, ['model' => $theme]);
    }
} 
