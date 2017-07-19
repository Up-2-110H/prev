<?php

$config = [
    'id' => 'web',
    'on afterRequest' => function () {
        /**
         * see. https://content-security-policy.com/
         */
        Yii::$app->getResponse()->getHeaders()->add('Content-Security-Policy',
            'default-src \'none\'; script-src \'self\' \'unsafe-inline\'; connect-src \'self\'; img-src \'self\' data:; style-src \'self\' \'unsafe-inline\'; font-src \'self\'; frame-src \'self\';');
    },
    'modules' => [],
    'components' => [
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
            'cookieValidationKey' => hash('sha512', __FILE__ . __LINE__),
        ],
        'user' => [
            'class' => 'yii\web\User',
            'identityClass' => 'app\modules\cabinet\models\Client',
            'loginUrl' => ['/cabinet/default/login'],
            // http://www.yiiframework.com/doc-2.0/yii-web-user.html#loginRequired()-detail
            'returnUrl' => ['/cabinet/view/index'],
            // Whether to enable cookie-based login: Yii::$app->user->login($this->getUser(), 24 * 60 * 60)
            'enableAutoLogin' => false,
            // http://www.yiiframework.com/doc-2.0/yii-web-user.html#$authTimeout-detail
            'authTimeout' => 1 * 60 * 60,
            'on afterLogin' => [
                'app\modules\cabinet\components\ClientEventHandler',
                'handleAfterLogin',
            ],
            'on afterLogout' => [
                'app\modules\cabinet\components\ClientEventHandler',
                'handleAfterLogout',
            ],
        ],
        'authClientCollection' => [
            'class' => 'yii\authclient\Collection',
            'clients' => [
                'yandex' => [
                    'class' => 'app\modules\cabinet\clients\YandexOAuth',
                    'clientId' => '',
                    'clientSecret' => '',
                    'normalizeUserAttributeMap' => [
                        'email' => 'default_email',
                    ],
                ],
                'google' => [
                    'class' => 'app\modules\cabinet\clients\GoogleOAuth',
                    'clientId' => '',
                    'clientSecret' => '',
                    'normalizeUserAttributeMap' => [
                        'login' => ['emails', 0, 'value'],
                        'email' => ['emails', 0, 'value'],
                    ],
                ],
                'vkontakte' => [
                    'class' => 'app\modules\cabinet\clients\VKontakte',
                    'clientId' => '',
                    'clientSecret' => '',
                    'normalizeUserAttributeMap' => [
                        'id' => 'user_id',
                        'login' => 'screen_name',
                    ],
                ],
                'facebook' => [
                    'class' => 'app\modules\cabinet\clients\Facebook',
                    'clientId' => '',
                    'clientSecret' => '',
                    'normalizeUserAttributeMap' => [
                        'login' => 'id',
                    ],
                ],
                'twitter' => [
                    'class' => 'app\modules\cabinet\clients\Twitter',
                    'consumerKey' => '',
                    'consumerSecret' => '',
                    'normalizeUserAttributeMap' => [
                        'login' => 'screen_name',
                    ],
                ],
                'gitlab' => [
                    'class' => 'app\modules\cabinet\clients\GitLab',
                    'clientId' => '00f41076e5ef79f35f2b5689ee5c6bc6fe47dd3dd5ff34d05a009c20f9aaee59',
                    'clientSecret' => 'f6aff4a87f89b1eab42173b3da36873912fe384114b2391ff3ff38863e8ac29d',
                    'normalizeUserAttributeMap' => [
                        'login' => 'username',
                    ],
                ],
                'ok' => [
                    'class' => 'app\modules\cabinet\clients\Ok',
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
}

return \yii\helpers\ArrayHelper::merge(require(__DIR__ . DIRECTORY_SEPARATOR . 'common.php'), $config);
