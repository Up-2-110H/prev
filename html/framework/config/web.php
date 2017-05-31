<?php

$config = [
    'id' => 'web',
    'modules' => [
        'cp' => [
            'class' => 'app\modules\cp\Module',
            'controllerNamespace' => 'app\modules\cp\controllers\backend',
        ],
    ],
    'components' => [
        'language' => [
            'class' => 'app\components\language\Language',
            'list' => [
                [
                    'iso' => 'ru-RU',
                    'title' => 'Russian',
                ],
                [
                    'iso' => 'en-US',
                    'title' => 'English',
                ],
            ],
        ],
        'assetManager' => [
            'class' => 'yii\web\AssetManager',
            'appendTimestamp' => true,
            'dirMode' => 0755,
            'fileMode' => 0644,
            'bundles' => [
                'yii\web\JqueryAsset' => [
                    'js' => [
                        YII_ENV_DEV ? 'jquery.js' : 'jquery.min.js',
                    ],
                ],
                'yii\bootstrap\BootstrapAsset' => [
                    'css' => [
                        YII_ENV_DEV ? 'css/bootstrap.css' : 'css/bootstrap.min.css',
                    ],
                ],
                'yii\bootstrap\BootstrapPluginAsset' => [
                    'js' => [
                        YII_ENV_DEV ? 'js/bootstrap.js' : 'js/bootstrap.min.js',
                    ],
                ],
            ],
        ],
        'session' => [
            'class' => 'yii\web\CacheSession',
        ],
        'request' => [
            'class' => 'app\components\language\LanguageRequest',
            'cookieValidationKey' => hash('sha512', __FILE__ . __LINE__),
        ],
        'errorHandler' => [
            'class' => 'yii\web\ErrorHandler',
            'errorAction' => 'site/error',
        ],
    ],
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        'allowedIPs' => [
            '*',
        ],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        'allowedIPs' => [
            '127.0.0.1',
            '::1',
            '172.72.*.*',
        ],
    ];
}

return \yii\helpers\ArrayHelper::merge(require(__DIR__ . DIRECTORY_SEPARATOR . 'common.php'), $config);
