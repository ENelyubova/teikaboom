<?php

/**
 * Виджет вывода Справочиников
 *
 * @category YupeWidget
 * @package  yupe.modules.news.widgets
 * @author   YupeTeam <team@yupe.ru>
 * @license  BSD http://ru.wikipedia.org/wiki/%D0%9B%D0%B8%D1%86%D0%B5%D0%BD%D0%B7%D0%B8%D1%8F_BSD
 * @version  0.5.3
 * @link     http://yupe.ru
 *
 **/
Yii::import('application.modules.dictionary.models.*');

class DictionaryGroupWidget extends yupe\widgets\YWidget
{
    public $id;
    public $code = null;

    public $view = 'dictionary-group-widget';

    public function run()
    {
        if($this->id){
            $models = DictionaryGroup::model()->findByPk($this->id);
        } else {
            $models = DictionaryGroup::model()->find([
                'condition' => 'code = :code',
                'params' => [
                    ':code' => $this->code,
                ],
            ]);
        }

        $this->render($this->view, ['models' => $models]);
    }
}
