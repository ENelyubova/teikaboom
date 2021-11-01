<?php
/**
 * ParkModule основной класс модуля park
 *
 * @author yupe team <team@yupe.ru>
 * @link https://yupe.ru
 * @copyright 2009-2021 amyLabs && Yupe! team
 * @package yupe.modules.park
 * @since 0.1
 */
Yii::import('application.modules.page.models.*');

class ParkModule  extends yupe\components\WebModule
{
    const VERSION = '0.9.8';
    /**
     * @var string
     */
    public $uploadPath = 'park';
    public $uploadPathDocs = 'park/document';
    /**
     * @var string
     */
    public $allowedExtensions = 'jpg,jpeg,png,gif';
    /**
     * @var int
     */
    public $minSize = 0;
    /**
     * @var int
     */
    public $maxSize = 5368709120;
    /**
     * @var int
     */
    public $maxFiles = 1;

    public $pageSlug;
    public $itemsPerPage = 20;

    /**
     * Массив с именами модулей, от которых зависит работа данного модуля
     *
     * @return array
     */
    public function getDependencies()
    {
        return parent::getDependencies();
    }

    /**
     * Работоспособность модуля может зависеть от разных факторов: версия php, версия Yii, наличие определенных модулей и т.д.
     * В этом методе необходимо выполнить все проверки.
     *
     * @return array или false
     */
    public function checkSelf()
    {
        return parent::checkSelf();
    }

    /**
     * Каждый модуль должен принадлежать одной категории, именно по категориям делятся модули в панели управления
     *
     * @return string
     */
    public function getCategory()
    {
        return Yii::t('ParkModule.park', 'content');
    }

    /**
     * массив лейблов для параметров (свойств) модуля. Используется на странице настроек модуля в панели управления.
     *
     * @return array
     */
    public function getParamsLabels()
    {
        return [
            'pageSlug' => Yii::t('ParkModule.park', 'Страница Наши парки'),
            'itemsPerPage' => Yii::t('ParkModule.park', 'Parks per page'),
        ];
        // return parent::getParamsLabels();
    }

    /**
     * массив параметров модуля, которые можно редактировать через панель управления (GUI)
     *
     * @return array
     */
    public function getEditableParams()
    {
        return [
            'pageSlug' => $this->getPages(),
            'itemsPerPage'
        ];
        // return parent::getEditableParams();
    }

    /**
     * массив групп параметров модуля, для группировки параметров на странице настроек
     *
     * @return array
     */
    public function getEditableParamsGroups()
    {
        return parent::getEditableParamsGroups();
    }

    /**
     * если модуль должен добавить несколько ссылок в панель управления - укажите массив
     *
     * @return array
     */
    public function getNavigation()
    {
        return [
            ['label' => Yii::t('ParkModule.park', 'park')],
            [
                'icon' => 'fa fa-fw fa-list-alt',
                'label' => Yii::t('ParkModule.park', 'Парки'),
                'url' => ['/park/parkBackend/index']
            ],
            [
                'icon' => 'fa fa-fw fa-list-alt',
                'label' => Yii::t('ParkModule.park', 'Страницы'),
                'url' => ['/park/ParkPageBackend/index']
            ],
        ];
    }

    /**
     * текущая версия модуля
     *
     * @return string
     */
    public function getVersion()
    {
        return Yii::t('ParkModule.park', self::VERSION);
    }

    /**
     * веб-сайт разработчика модуля или страничка самого модуля
     *
     * @return string
     */
    public function getUrl()
    {
        return Yii::t('ParkModule.park', 'https://yupe.ru');
    }

    /**
     * Возвращает название модуля
     *
     * @return string.
     */
    public function getName()
    {
        return Yii::t('ParkModule.park', 'park');
    }

    /**
     * Возвращает описание модуля
     *
     * @return string.
     */
    public function getDescription()
    {
        return Yii::t('ParkModule.park', 'Описание модуля "park"');
    }

    /**
     * Имя автора модуля
     *
     * @return string
     */
    public function getAuthor()
    {
        return Yii::t('ParkModule.park', 'yupe team');
    }

    /**
     * Контактный email автора модуля
     *
     * @return string
     */
    public function getAuthorEmail()
    {
        return Yii::t('ParkModule.park', 'team@yupe.ru');
    }

    /**
     * Ссылка, которая будет отображена в панели управления
     * Как правило, ведет на страничку для администрирования модуля
     *
     * @return string
     */
    public function getAdminPageLink()
    {
        return '/park/parkBackend/index';
    }

    /**
     * Название иконки для меню админки, например 'user'
     *
     * @return string
     */
    public function getIcon()
    {
        return "fa fa-fw fa-pencil";
    }

    /**
      * Возвращаем статус, устанавливать ли галку для установки модуля в инсталяторе по умолчанию:
      *
      * @return bool
      **/
    public function getIsInstallDefault()
    {
        return parent::getIsInstallDefault();
    }

    /**
     * Инициализация модуля, считывание настроек из базы данных и их кэширование
     *
     * @return void
     */
    public function init()
    {
        parent::init();

        $this->setImport(
            [
                'park.models.*',
                'park.components.*',
            ]
        );
    }

    /**
     * Массив правил модуля
     * @return array
     */
    public function getAuthItems()
    {
        return [
            [
                'name' => 'Park.ParkManager',
                'description' => Yii::t('ParkModule.park', 'Manage park'),
                'type' => AuthItem::TYPE_TASK,
                'items' => [
                    [
                        'type' => AuthItem::TYPE_OPERATION,
                        'name' => 'Park.ParkBackend.Index',
                        'description' => Yii::t('ParkModule.park', 'Index')
                    ],
                ]
            ]
        ];
    }

    public function getPages()
    {
        return CHtml::listData(Page::model()->findAll(), 'slug', 'title');
    }

    public function getParkPageViewsList()
    {
        return [
            'view-banquet-rooms' => 'Шаблон страницы - Банкетные комнаты',
            'view-attraction'    => 'Шаблон страницы - Аттракционы',
            'view-services'      => 'Шаблон страницы - Услуги',
            'view-restaurants'   => 'Шаблон страницы - Рестораны',
        ];
    }
}
