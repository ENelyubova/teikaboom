<?php
/**
 * MasterclassModule основной класс модуля masterclass
 *
 * @author yupe team <team@yupe.ru>
 * @link https://yupe.ru
 * @copyright 2009-2021 amyLabs && Yupe! team
 * @package yupe.modules.masterclass
 * @since 0.1
 */

class MasterclassModule  extends yupe\components\WebModule
{
    const VERSION = '0.9.8';
    /**
     * @var string
     */
    public $uploadPath = 'masterclass';
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

    public $pageId;
    public $pageAfishaId;
    public $itemsPerPage = 9;

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
        return Yii::t('MasterclassModule.masterclass', 'content');
    }

    /**
     * массив лейблов для параметров (свойств) модуля. Используется на странице настроек модуля в панели управления.
     *
     * @return array
     */
    public function getParamsLabels()
    {
        return [
            'pageId' => Yii::t('MasterclassModule.masterclass', 'Страница Мастер класса'),
            'pageAfishaId' => Yii::t('MasterclassModule.masterclass', 'Страница Афиша'),
            'itemsPerPage' => Yii::t('MasterclassModule.masterclass', 'Мастер классов на странице'),
        ];
    }

    /**
     * массив параметров модуля, которые можно редактировать через панель управления (GUI)
     *
     * @return array
     */
    public function getEditableParams()
    {
        return [
            'pageId' => $this->getPages(),
            'pageAfishaId' => $this->getPages(),
            'itemsPerPage'
        ];
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
            ['label' => Yii::t('MasterclassModule.masterclass', 'masterclass')],
            [
                'icon' => 'fa fa-fw fa-folder-open',
                'label' => Yii::t('MasterclassModule.masterclass', 'Темы для мероприятий'),
                'url' => ['/masterclass/masterclassThemeBackend/index'],
            ],
            [
                'icon' => 'fa fa-fw fa-list-alt',
                'label' => Yii::t('MasterclassModule.masterclass', 'Index'),
                'url' => ['/masterclass/masterclassBackend/index']
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
        return Yii::t('MasterclassModule.masterclass', self::VERSION);
    }

    /**
     * веб-сайт разработчика модуля или страничка самого модуля
     *
     * @return string
     */
    public function getUrl()
    {
        return Yii::t('MasterclassModule.masterclass', 'https://yupe.ru');
    }

    /**
     * Возвращает название модуля
     *
     * @return string.
     */
    public function getName()
    {
        return Yii::t('MasterclassModule.masterclass', 'masterclass');
    }

    /**
     * Возвращает описание модуля
     *
     * @return string.
     */
    public function getDescription()
    {
        return Yii::t('MasterclassModule.masterclass', 'Описание модуля "masterclass"');
    }

    /**
     * Имя автора модуля
     *
     * @return string
     */
    public function getAuthor()
    {
        return Yii::t('MasterclassModule.masterclass', 'yupe team');
    }

    /**
     * Контактный email автора модуля
     *
     * @return string
     */
    public function getAuthorEmail()
    {
        return Yii::t('MasterclassModule.masterclass', 'team@yupe.ru');
    }

    /**
     * Ссылка, которая будет отображена в панели управления
     * Как правило, ведет на страничку для администрирования модуля
     *
     * @return string
     */
    public function getAdminPageLink()
    {
        return '/masterclass/masterclassBackend/index';
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
                'masterclass.models.*',
                'masterclass.components.*',
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
                'name' => 'Masterclass.MasterclassManager',
                'description' => Yii::t('MasterclassModule.masterclass', 'Manage masterclass'),
                'type' => AuthItem::TYPE_TASK,
                'items' => [
                    [
                        'type' => AuthItem::TYPE_OPERATION,
                        'name' => 'Masterclass.MasterclassBackend.Index',
                        'description' => Yii::t('MasterclassModule.masterclass', 'Мастер классы')
                    ],
                ]
            ]
        ];
    }

    public function getPages()
    {
        return Page::model()->getFormattedList();
    }
}
