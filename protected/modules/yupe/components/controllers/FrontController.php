<?php
/**
 * Базовый класс для всех контроллеров публичной части
 *
 * @category YupeComponents
 * @package  yupe.modules.yupe.components.controllers
 * @author   YupeTeam <team@yupe.ru>
 * @license  BSD https://raw.github.com/yupe/yupe/master/LICENSE
 * @version  0.6
 * @link     https://yupe.ru
 **/

namespace yupe\components\controllers;

use Yii;
use yupe\events\YupeControllerInitEvent;
use yupe\events\YupeEvents;
use application\components\Controller;

Yii::import('application.components.TinyMinify.TinyMinify');

/**
 * Class FrontController
 * @package yupe\components\controllers
 */
abstract class FrontController extends Controller
{
    public $mainAssets;
    public $webp_support;
    public $bodyClass;
    public $footerClass;
    public $storeItem = "_item";
    public $storeCountPage = 20;
    /**
     * Вызывается при инициализации FrontController
     * Присваивает значения, необходимым переменным
     */
    public function init()
    {
        Yii::app()->eventManager->fire(YupeEvents::BEFORE_FRONT_CONTROLLER_INIT, new YupeControllerInitEvent($this, Yii::app()->getUser()));

        parent::init();

        Yii::app()->theme = $this->yupe->theme ?: 'default';

        $this->mainAssets = Yii::app()->getTheme()->getAssetsUrl();

        $bootstrap = Yii::app()->getTheme()->getBasePath() . DIRECTORY_SEPARATOR . "bootstrap.php";

        if (is_file($bootstrap)) {
            require $bootstrap;
        }

        $this->webpSupport();
    }

    /**
     * @return array
     */
    public function behaviors()
    {
        return [
            'InlineWidgetsBehavior' => [
                'class' => 'yupe.components.behaviors.InlineWidgetsBehavior',
                'classSuffix' => 'Widget',
                'startBlock' => '[[w:',
                'endBlock' => ']]',
                'widgets' => Yii::app()->params['runtimeWidgets'],
            ],
        ];
    }

    public function beforeAction($action)
    {
        if(isset($_COOKIE["store_item"])) {
            $this->storeItem = $_COOKIE["store_item"];
        }

        if(isset($_COOKIE["store_count"])) {
            $this->storeCountPage = $_COOKIE["store_count"];
        }

        return parent::beforeAction($action);
    }

    public function afterRender($view, &$output)
    {
        if (!YII_DEBUG) {
            $output = \TinyMinify::html($output, $options = [
                'collapse_whitespace' => false,
                'disable_comments' => false,
            ]);
        }

        return parent::afterRender($view, $output);
    }

    public function webpSupport()
    {
        $this->webp_support = true;

        if(strpos($_SERVER['HTTP_ACCEPT'], 'image/webp') === false) {
            $this->webp_support = false; // webp  не поддерживается
        }
    }
}
