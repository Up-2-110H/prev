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
        '@root' => dirname(dirname(__DIR__)) . '/web',
        '@bower' => '@vendor/bower-asset',
        '@npm' => '@vendor/npm-asset',
        '@themes' => '@vendor/yii2-developer/yii2-paperDashboard',
        '@public' => '@root/uploads',
    ],
    'container' => [
        'singletons' => [],
        'definitions' => [],
    ],
    'modules' => [
        'content' => [
            'class' => \krok\content\Module::class,
            'layouts' => [
                '//index' => 'Главная',
                '//common' => 'Типовая',
            ],
            'views' => [
                'index' => 'Главная',
                'about' => 'О нас',
            ],
        ],
    ],
    'components' => [
        'authManager' => [
            'class' => \yii\rbac\DbManager::class,
            'cache' => 'cache',
        ],
        'language' => [
            'class' => \app\components\language\Language::class,
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
        'urlManager' => [
            'class' => \app\components\language\LanguageUrlManager::class,
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'normalizer' => [
                'class' => \yii\web\UrlNormalizer::class,
            ],
            'rules' => [],
        ],
        'formatter' => [
            'class' => \yii\i18n\Formatter::class,
            'numberFormatterSymbols' => [
                \NumberFormatter::CURRENCY_SYMBOL => 'руб.',
            ],
        ],
        'security' => [
            'class' => \yii\base\Security::class,
            'passwordHashCost' => 15,
        ],
        'session' => [
            'class' => \yii\web\CacheSession::class,
            'cache' => [
                'class' => \yii\redis\Cache::class,
                'defaultDuration' => 0,
                'keyPrefix' => hash('crc32', __FILE__),
                'redis' => [
                    'hostname' => 'redis',
                    'port' => 6379,
                    'database' => 1,
                ],
            ],
        ],
        'cache' => [
            'class' => \yii\redis\Cache::class,
            'defaultDuration' => 24 * 60 * 60,
            'keyPrefix' => hash('crc32', __FILE__),
            'redis' => [
                'hostname' => 'redis',
                'port' => 6379,
                'database' => 0,
            ],
        ],
        'mailer' => [
            'class' => \yii\swiftmailer\Mailer::class,
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => 'smtp.yandex.ru',
                'username' => 'logging@dev-vps.ru',
                'password' => 'dev-vps.ru@logging',
                'port' => 465,
                'encryption' => 'ssl',
            ],
            'useFileTransport' => YII_DEBUG, // @runtime/mail/
        ],
        'i18n' => [
            'class' => \yii\i18n\I18N::class,
            'translations' => [
                'app' => [
                    'class' => \yii\i18n\PhpMessageSource::class,
                    'sourceLanguage' => 'en-US',
                ],
                'system' => [
                    'class' => \yii\i18n\PhpMessageSource::class,
                    'sourceLanguage' => 'en-US',
                    'basePath' => '@app/messages',
                ],
            ],
        ],
        'log' => [
            'class' => \yii\log\Dispatcher::class,
            'traceLevel' => YII_ENV_PROD ? 0 : 3,
            'targets' => [
                'email' => [
                    'class' => \yii\log\EmailTarget::class,
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
                            'logging@dev-vps.ru' => 'Logging',
                        ],
                        'subject' => 'CMF2',
                    ],
                    'enabled' => true,
                ],
                'file' => [
                    'class' => \yii\log\FileTarget::class,
                    'levels' => [
                        'error',
                        'warning',
                    ],
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
