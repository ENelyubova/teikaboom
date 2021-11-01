<?php

return [
    'preload' => [
        'debug'
    ],
    'modules' => [
        /*'gii' => [ // you can access gii by following url http://site.com/gii/default/login
            'class' => 'system.gii.GiiModule',
            'password' => 'giiYupe',
            'generatorPaths' => [
                'application.modules.yupe.extensions.yupe.gii',
            ],
            'ipFilters' => [],
        ],*/
    ],
    'components' => [
        'assetManager' => [
            // 'linkAssets' => true,
            'forceCopy' => true
        ],
        'debug' => [
            'class' => 'vendor.zhuravljov.yii2-debug.Yii2Debug',
            'internalUrls' => true
        ],
        'cache' => [
            'class' => 'CDummyCache',
        ],
        'urlManager' => [
            'rules' => [
                '/gii/<controller:\w+>/<action:\w+>' => 'gii/<controller>/<action>',
                '/debug/' => 'debug/default/index',
                '/debug/<tag:[0-9a-f]+>/<action:toolbar|explain>' => 'debug/default/<action>',
                '/debug/<tag:[0-9a-f]+>/<panel:\w+>' => 'debug/default/view',
                '/debug/latest/<panel:\w+>' => 'debug/default/view',
                '/debug/<action:\w+>' => 'debug/default/<action>',
            ]
        ],
    ]
];
