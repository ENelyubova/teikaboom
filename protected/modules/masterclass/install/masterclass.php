<?php
/**
 * Файл настроек для модуля masterclass
 *
 * @author yupe team <team@yupe.ru>
 * @link https://yupe.ru
 * @copyright 2009-2021 amyLabs && Yupe! team
 * @package yupe.modules.masterclass.install
 * @since 0.1
 *
 */
return [
    'module'    => [
        'class' => 'application.modules.masterclass.MasterclassModule',
    ],
    'import'    => [
        'application.modules.masterclass.components.repository.*',
    ],
    'component' => [
        'themeFilter' => [
            'class' => 'application.modules.masterclass.components.ThemeFilter'
        ],
        'posterRepository' => [
            'class' => 'application.modules.masterclass.components.repository.PosterRepository'
        ],
    ],
    'rules'     => [
        '/masterclass' => 'masterclass/masterclass/index',
        '/afisha' => 'masterclass/masterclass/afisha',
        '/masterclass/<slug>' => 'masterclass/masterclass/view',
    ],
];