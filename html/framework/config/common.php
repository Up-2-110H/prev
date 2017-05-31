<?php
/**
 * Created by PhpStorm.
 * User: krok
 * Date: 08.02.17
 * Time: 23:35
 */

return [
    'name' => 'CMF2',
    'timeZone' => 'UTC',
    'language' => 'ru-RU',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm' => '@vendor/npm-asset',
    ],
    'components' => [
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
            'cache' => 'cache',
        ],
        'urlManager' => [
            'class' => 'app\components\language\LanguageUrlManager',
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'normalizer' => [
                'class' => 'yii\web\UrlNormalizer',
            ],
            'rules' => require(__DIR__ . DIRECTORY_SEPARATOR . 'rules.php'),
        ],
        'formatter' => [
            'class' => 'yii\i18n\Formatter',
            'numberFormatterSymbols' => [
                \NumberFormatter::CURRENCY_SYMBOL => 'руб.',
            ],
        ],
        'security' => [
            'class' => 'yii\base\Security',
            'passwordHashCost' => 15,
        ],
        'cache' => [
            'class' => 'yii\redis\Cache',
            'defaultDuration' => 24 * 60 * 60,
            'keyPrefix' => hash('crc32', __FILE__),
            'redis' => [
                'hostname' => 'redis',
                'port' => 6379,
                'database' => 0,
            ],
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'useFileTransport' => YII_DEBUG, // @runtime/mail/
        ],
        'i18n' => [
            'class' => 'yii\i18n\I18N',
            'translations' => [
                'app' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'sourceLanguage' => 'en-US',
                ],
                'cp' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'sourceLanguage' => 'en-US',
                    'basePath' => '@app/messages',
                ],
            ],
        ],
        'log' => [
            'class' => 'yii\log\Dispatcher',
            'traceLevel' => YII_ENV_PROD ? 0 : 3,
            'targets' => [
                'email' => [
                    'class' => 'yii\log\EmailTarget',
                    'levels' => ['error', 'warning'],
                    'except' => [
                        'yii\web\HttpException:404',
                        //'yii\web\HttpException:403',
                    ],
                    'message' => [
                        'to' => [
                            'webmaster@dev-vps.ru',
                        ],
                        'from' => [
                            'logging@dev-vps.ru',
                        ],
                        'subject' => 'Logging',
                    ],
                    'enabled' => true,
                ],
                'file' => [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                    'except' => [
                        'yii\web\HttpException:404',
                        //'yii\web\HttpException:403',
                    ],
                    'enabled' => YII_ENV_PROD,
                ],
            ],
        ],
        'db' => require(__DIR__ . DIRECTORY_SEPARATOR . 'db.php'),
    ],
    'params' => require(__DIR__ . DIRECTORY_SEPARATOR . 'params.php'),
];
