<?php
/**
 * Файл настроек для модуля park
 *
 * @author yupe team <team@yupe.ru>
 * @link https://yupe.ru
 * @copyright 2009-2021 amyLabs && Yupe! team
 * @package yupe.modules.park.install
 * @since 0.1
 *
 */
return [
    'module'    => [
        'class' => 'application.modules.park.ParkModule',
    ],
    'import'    => [
        'application.modules.park.models.*',
    ],
    'component' => [],
    'rules'     => [
        // '/park' => 'park/park/index',
        '/park/<slug>' => 'park/park/view',
        '/park/<slugPark>/<slug>' => 'park/parkPage/view',
    ],
];