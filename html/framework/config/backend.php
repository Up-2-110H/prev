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
    'on afterRequest' => function () {
        /**
         * see. https://content-security-policy.com/
         */
        Yii::$app->getResponse()->getHeaders()->add('Content-Security-Policy',
            'default-src \'none\'; script-src \'self\' \'unsafe-inline\'; connect-src \'self\'; img-src \'self\' data:; style-src \'self\' \'unsafe-inline\' fonts.googleapis.com maxcdn.bootstrapcdn.com; font-src \'self\' fonts.gstatic.com maxcdn.bootstrapcdn.com; child-src \'self\';');
    },
    'modules' => [
        'system' => [
            'class' => 'app\modules\system\Module',
            'viewPath' => '@app/modules/system/views/backend',
            'controllerNamespace' => 'app\modules\system\controllers\backend',
        ],
        'auth' => [
            'class' => 'app\modules\auth\Module',
            'viewPath' => '@app/modules/auth/views/backend',
            'controllerNamespace' => 'app\modules\auth\controllers\backend',
        ],
        'example' => [
            'class' => 'app\modules\example\Module',
            'viewPath' => '@app/modules/example/views/backend',
            'controllerNamespace' => 'app\modules\example\controllers\backend',
        ],
    ],
    'components' => [
        'view' => [
            'class' => 'yii\web\View',
            'theme' => [
                'class' => 'yii\base\Theme',
                'basePath' => '@themes/paperDashboard',
                'baseUrl' => '@themes/paperDashboard',
                'pathMap' => [
                    '@app/modules/system/views/backend/layouts' => '@app/themes/paperDashboard/views/layouts',
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
        'request' => [
            'class' => 'app\components\language\LanguageRequest',
            'csrfParam' => '_backendCSRF',
            'cookieValidationKey' => hash('sha512', __FILE__ . __LINE__),
        ],
        'user' => [
            'class' => 'yii\web\User',
            'identityClass' => 'app\modules\auth\models\Auth',
            'idParam' => '__idBackend',
            'authTimeoutParam' => '__expireBackend',
            'absoluteAuthTimeoutParam' => '__absoluteExpireBackend',
            'returnUrlParam' => '__returnUrlBackend',
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
        'generators' => [
            'module' => [
                'class' => 'yii\gii\generators\module\Generator',
                'messageCategory' => 'system',
                'templates' => [
                    'paperDashboard' => '@themes/paperDashboard/gii/module',
                ],
                'template' => 'paperDashboard',
            ],
            'model' => [
                'class' => 'yii\gii\generators\model\Generator',
                'generateQuery' => true,
                'useTablePrefix' => true,
                'messageCategory' => 'system',
                'templates' => [
                    'paperDashboard' => '@themes/paperDashboard/gii/model',
                ],
                'template' => 'paperDashboard',
            ],
            'crud' => [
                'class' => 'yii\gii\generators\crud\Generator',
                'enableI18N' => true,
                'baseControllerClass' => 'app\modules\system\components\backend\Controller',
                'messageCategory' => 'system',
                'templates' => [
                    'paperDashboard' => '@themes/paperDashboard/gii/crud',
                ],
                'template' => 'paperDashboard',
            ],
        ],
        'allowedIPs' => [
            '127.0.0.1',
            '::1',
            '172.72.*.*',
        ],
    ];
}

return \yii\helpers\ArrayHelper::merge(require(__DIR__ . DIRECTORY_SEPARATOR . 'common.php'), $config);
