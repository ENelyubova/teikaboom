<?php

/**
 * Виджет вывода значения справочиника
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

class DictionaryDataWidget extends yupe\widgets\YWidget
{
    public $id; // Id значения в справочнике
    public $code = null; // code значения в справочнике
    public $group_id; // id справочника

    public $view = 'dictionary-widget';
    public $viewAll = 'dictionary-all-widget';

    public function run()
    {
        if($this->id){
            $cacheName = "DictionaryData-id-{$this->id}";
        } else if($this->group_id){
            $cacheName = "DictionaryData-group-{$this->group_id}";
        } else{
            $cacheName = "DictionaryData-code-{$this->code}";
        }
        
        $models = Yii::app()->getCache()->get($cacheName);
        
        if (false === $models) {
            if($this->group_id){
                $models = DictionaryData::model()->published()->findAll([
                    'condition' => 'group_id = :group_id',
                    'params' => [
                        ':group_id' => $this->group_id,
                    ],
                ]);
                $this->view = $this->viewAll;
            } else {
                if($this->id){
                    $models = DictionaryData::model()->published()->findByPk($this->id);
                } else {
                    $models = DictionaryData::model()->published()->find([
                        'condition' => 'code = :code',
                        'params' => [
                            ':code' => $this->code,
                        ],
                    ]);
                }
            }
            Yii::app()->getCache()->set($cacheName, $models);
        }

        $this->render($this->view, ['models' => $models]);
    }
}
