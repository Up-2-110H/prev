<?php

$config = [
    'id' => 'web',
    'defaultRoute' => 'system',
    'as beforeRequest' => [
        'class' => 'app\modules\system\components\backend\AccessControl',
        'except' => [
            'gii/*',
            'debug/*',
            'auth/default/oauth',
            'auth/default/login',
            'auth/default/logout',
            'auth/default/captcha',
        ],
    ],
    'modules' => [
        'system' => [
            'class' => 'app\modules\system\Module',
            'controllerNamespace' => 'app\modules\system\controllers\backend',
        ],
        'auth' => [
            'class' => 'app\modules\auth\Module',
            'controllerNamespace' => 'app\modules\auth\controllers\backend',
        ],
    ],
    'components' => [
        'view' => [
            'class' => 'yii\web\View',
            'theme' => [
                'basePath' => '@themes/paperDashboard',
                'baseUrl' => '@themes/paperDashboard',
                'pathMap' => [
                    '@app/modules' => '@themes/paperDashboard/modules',
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
                    'sourcePath' => '@themes/paperDashboard/assets/dist',
                    'js' => [
                        'js/jquery-3.1.1.min.js',
                    ],
                ],
                /*
                'yii\jui\JuiAsset' => [
                    'sourcePath' => '@themes/paperDashboard/assets/dist',
                    'js' => [
                        'js/jquery-ui.min.js',
                    ],
                    'css' => [],
                ],
                */
                'yii\bootstrap\BootstrapAsset' => [
                    'sourcePath' => '@themes/paperDashboard/assets/dist',
                    'css' => [
                        'css/bootstrap.min.css',
                    ],
                ],
                'yii\bootstrap\BootstrapPluginAsset' => [
                    'sourcePath' => '@themes/paperDashboard/assets/dist',
                    'js' => [
                        'js/bootstrap.min.js',
                    ],
                ],
            ],
        ],
        'request' => [
            'class' => 'app\components\language\LanguageRequest',
            'csrfParam' => '_backendCSRF',
            'cookieValidationKey' => hash('sha512', __FILE__ . __LINE__),
        ],
        'user' => [
            'class' => 'yii\web\User',
            'identityClass' => 'app\modules\auth\models\Auth',
            'loginUrl' => ['/auth/default/login'],
            // http://www.yiiframework.com/doc-2.0/yii-web-user.html#loginRequired()-detail
            'returnUrl' => ['/'],
            // Whether to enable cookie-based login: Yii::$app->user->login($this->getUser(), 24 * 60 * 60)
            'enableAutoLogin' => false,
            // http://www.yiiframework.com/doc-2.0/yii-web-user.html#$authTimeout-detail
            'authTimeout' => 1 * 60 * 60,
            'on afterLogin' => [
                'app\modules\auth\components\UserEventHandler',
                'handleAfterLogin',
            ],
            'on afterLogout' => [
                'app\modules\auth\components\UserEventHandler',
                'handleAfterLogout',
            ],
        ],
        'authClientCollection' => [
            'class' => 'yii\authclient\Collection',
            'clients' => [
                'yandex' => [
                    'class' => 'app\modules\auth\clients\YandexOAuth',
                    'clientId' => '',
                    'clientSecret' => '',
                    'normalizeUserAttributeMap' => [
                        'email' => 'default_email',
                    ],
                ],
                'google' => [
                    'class' => 'app\modules\auth\clients\GoogleOAuth',
                    'clientId' => '',
                    'clientSecret' => '',
                    'normalizeUserAttributeMap' => [
                        'login' => ['emails', 0, 'value'],
                        'email' => ['emails', 0, 'value'],
                    ],
                ],
                'vkontakte' => [
                    'class' => 'app\modules\auth\clients\VKontakte',
                    'clientId' => '',
                    'clientSecret' => '',
                    'normalizeUserAttributeMap' => [
                        'id' => 'user_id',
                        'login' => 'screen_name',
                    ],
                ],
                'facebook' => [
                    'class' => 'app\modules\auth\clients\Facebook',
                    'clientId' => '',
                    'clientSecret' => '',
                    'normalizeUserAttributeMap' => [
                        'login' => 'id',
                    ],
                ],
                'twitter' => [
                    'class' => 'app\modules\auth\clients\Twitter',
                    'consumerKey' => '',
                    'consumerSecret' => '',
                    'normalizeUserAttributeMap' => [
                        'login' => 'screen_name',
                    ],
                ],
                'gitlab' => [
                    'class' => 'app\modules\auth\clients\GitLab',
                    'clientId' => '',
                    'clientSecret' => '',
                    'normalizeUserAttributeMap' => [
                        'login' => 'username',
                    ],
                ],
                'ok' => [
                    'class' => 'app\modules\auth\clients\Ok',
                    'clientId' => '',
                    'clientSecret' => '',
                    'applicationKey' => '',
                    'normalizeUserAttributeMap' => [
                        'login' => 'uid',
                    ],
                    'scope' => 'VALUABLE_ACCESS,GET_EMAIL',
                ],
            ],
        ],
        'errorHandler' => [
            'class' => 'yii\web\ErrorHandler',
            'errorAction' => 'system/default/error',
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
