<?php

$config = [
    'id' => 'web',
    'defaultRoute' => 'system',
    'as beforeRequest' => [
        'class' => \krok\system\components\backend\AccessControl::class,
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
            'default-src none; script-src \'self\' \'unsafe-inline\'; connect-src \'self\'; img-src \'self\' data:; style-src \'self\' \'unsafe-inline\' fonts.googleapis.com maxcdn.bootstrapcdn.com; font-src \'self\' fonts.gstatic.com maxcdn.bootstrapcdn.com; child-src \'self\';');
    },
    'container' => [
        'definitions' => [
            'yii\captcha\CaptchaAction' => [
                'backColor' => 0xf3f3f5,
            ],
        ],
    ],
    'modules' => [
        'system' => [
            'class' => \krok\system\Module::class,
            'viewPath' => '@vendor/yii2-developer/yii2-system/views/backend',
            'controllerNamespace' => 'krok\system\controllers\backend',
        ],
        'auth' => [
            'class' => 'app\modules\auth\Module', // todo
            'viewPath' => '@app/modules/auth/views/backend',
            'controllerNamespace' => 'app\modules\auth\controllers\backend',
        ],
        'example' => [
            'class' => \krok\example\Module::class,
            'viewPath' => '@vendor/yii2-developer/yii2-example/views/backend',
            'controllerNamespace' => 'krok\example\controllers\backend',
        ],
    ],
    'components' => [
        'view' => [
            'class' => \yii\web\View::class,
            'theme' => [
                'class' => \yii\base\Theme::class,
                'basePath' => '@themes',
                'baseUrl' => '@themes',
                'pathMap' => [
                    '@vendor/yii2-developer/yii2-system/views/backend' => '@app/modules/system/views/backend',
                    '@vendor/yii2-developer/yii2-system/views/backend/layouts' => '@themes/views/layouts',
                ],
            ],
        ],
        'urlManager' => [
            'rules' => require(__DIR__ . DIRECTORY_SEPARATOR . 'backend' . DIRECTORY_SEPARATOR . 'rules.php'),
        ],
        'assetManager' => [
            'class' => \yii\web\AssetManager::class,
            'appendTimestamp' => true,
            'dirMode' => 0755,
            'fileMode' => 0644,
            'bundles' => [
                \yii\web\JqueryAsset::class => [
                    'js' => [
                        YII_ENV_DEV ? 'jquery.js' : 'jquery.min.js',
                    ],
                ],
                \yii\bootstrap\BootstrapAsset::class => [
                    'css' => [
                        YII_ENV_DEV ? 'css/bootstrap.css' : 'css/bootstrap.min.css',
                    ],
                ],
                \yii\bootstrap\BootstrapPluginAsset::class => [
                    'js' => [
                        YII_ENV_DEV ? 'js/bootstrap.js' : 'js/bootstrap.min.js',
                    ],
                ],
            ],
        ],
        'request' => [
            'class' => \app\components\language\LanguageRequest::class,
            'csrfParam' => '_backendCSRF',
            'cookieValidationKey' => hash('sha512', __FILE__ . __LINE__),
        ],
        'user' => [
            'class' => \yii\web\User::class,
            'identityClass' => \app\modules\auth\models\Auth::class,
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
                \app\modules\auth\components\UserEventHandler::class,
                'handleAfterLogin',
            ],
            'on afterLogout' => [
                \app\modules\auth\components\UserEventHandler::class,
                'handleAfterLogout',
            ],
        ],
        'authClientCollection' => [
            'class' => \yii\authclient\Collection::class,
            'clients' => [
                'yandex' => [
                    'class' => \app\modules\auth\clients\YandexOAuth::class,
                    'clientId' => '',
                    'clientSecret' => '',
                    'normalizeUserAttributeMap' => [
                        'email' => 'default_email',
                    ],
                ],
                'google' => [
                    'class' => \app\modules\auth\clients\GoogleOAuth::class,
                    'clientId' => '',
                    'clientSecret' => '',
                    'normalizeUserAttributeMap' => [
                        'login' => ['emails', 0, 'value'],
                        'email' => ['emails', 0, 'value'],
                    ],
                ],
                'vkontakte' => [
                    'class' => \app\modules\auth\clients\VKontakte::class,
                    'clientId' => '',
                    'clientSecret' => '',
                    'normalizeUserAttributeMap' => [
                        'id' => 'user_id',
                        'login' => 'screen_name',
                    ],
                ],
                'facebook' => [
                    'class' => \app\modules\auth\clients\Facebook::class,
                    'clientId' => '',
                    'clientSecret' => '',
                    'normalizeUserAttributeMap' => [
                        'login' => 'id',
                    ],
                ],
                'twitter' => [
                    'class' => \app\modules\auth\clients\Twitter::class,
                    'consumerKey' => '',
                    'consumerSecret' => '',
                    'normalizeUserAttributeMap' => [
                        'login' => 'screen_name',
                    ],
                ],
                'gitlab' => [
                    'class' => \app\modules\auth\clients\GitLab::class,
                    'clientId' => '',
                    'clientSecret' => '',
                    'normalizeUserAttributeMap' => [
                        'login' => 'username',
                    ],
                ],
                'ok' => [
                    'class' => \app\modules\auth\clients\Ok::class,
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
            'class' => \yii\web\ErrorHandler::class,
            'errorAction' => 'system/default/error',
        ],
    ],
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => \yii\debug\Module::class,
        'allowedIPs' => [
            '*',
        ],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => \yii\gii\Module::class,
        'generators' => [
            'module' => [
                'class' => \yii\gii\generators\module\Generator::class,
                'messageCategory' => 'system',
                'templates' => [
                    'paperDashboard' => '@themes/gii/module',
                ],
                'template' => 'paperDashboard',
            ],
            'model' => [
                'class' => \yii\gii\generators\model\Generator::class,
                'generateQuery' => true,
                'useTablePrefix' => true,
                'messageCategory' => 'system',
                'templates' => [
                    'paperDashboard' => '@themes/gii/model',
                ],
                'template' => 'paperDashboard',
            ],
            'crud' => [
                'class' => \yii\gii\generators\crud\Generator::class,
                'enableI18N' => true,
                'baseControllerClass' => \krok\system\components\backend\Controller::class,
                'messageCategory' => 'system',
                'templates' => [
                    'paperDashboard' => '@themes/gii/crud',
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
