<?php
/**
 * Created by PhpStorm.
 * User: krok
 * Date: 08.02.17
 * Time: 23:35
 */

return \yii\helpers\ArrayHelper::merge([
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
        'singletons' => [
            \krok\sentry\Sentry::class => [
                'class' => \krok\sentry\Sentry::class,
                'dsn' => getenv('SENTRY_DSN'),
            ],
        ],
        'definitions' => [
            \yii\mail\MailerInterface::class => function () {
                return Yii::$app->getMailer();
            },
            \krok\storage\behaviors\UploaderBehavior::class => [
                'class' => \krok\storage\behaviors\UploaderBehavior::class,
                'uploadedDirectory' => '/storage',
            ],
            \krok\storage\behaviors\StorageBehavior::class => [
                'class' => \krok\storage\behaviors\StorageBehavior::class,
                'uploadedDirectory' => '/storage',
            ],
            \krok\tinymce\uploader\actions\UploaderAction::class => [
                'class' => \krok\tinymce\uploader\actions\UploaderAction::class,
                'uploadedDirectory' => '/editor',
            ],
            \League\Flysystem\AdapterInterface::class => function () {
                return Yii::createObject(\League\Flysystem\Adapter\Local::class, [Yii::getAlias('@public')]);
            },
            \League\Flysystem\FilesystemInterface::class => function () {
                $filesystem = Yii::createObject(\League\Flysystem\Filesystem::class);
                $filesystem->addPlugin(new \krok\filesystem\plugins\PublicUrl('/render/storage', 'getPublicUrl'));
                $filesystem->addPlugin(new \krok\filesystem\plugins\PublicUrl('/attachment/storage', 'getDownloadUrl'));
                $filesystem->addPlugin(new \krok\filesystem\plugins\PublicUrl('/attachment/editor', 'getEditorUrl'));
                $filesystem->addPlugin(new \krok\filesystem\plugins\HashGrid());

                return $filesystem;
            },
            \League\Glide\ServerFactory::class => function () {
                $server = League\Glide\ServerFactory::create([
                    'source' => Yii::createObject(\League\Flysystem\FilesystemInterface::class),
                    'cache' => Yii::createObject(\League\Flysystem\FilesystemInterface::class),
                    'cache_path_prefix' => 'cache',
                    'driver' => 'imagick',
                ]);

                return $server;
            },
            \krok\language\LanguageInterface::class => function () {
                $list = [
                    [
                        'iso' => 'ru-RU',
                        'title' => 'Русский',
                    ],
                ];

                return Yii::createObject(\krok\language\Language::class, [$list]);
            },
            \krok\configure\helpers\ConfigureHelperInterface::class => \krok\configure\helpers\ConfigureHelper::class,
            \krok\configure\serializers\SerializerInterface::class => \krok\configure\serializers\JsonSerializer::class,
            \krok\configure\ConfigureInterface::class => function () {
                $configurable = [
                    \krok\system\Configure::class,
                ];

                /** @var \krok\configure\serializers\SerializerInterface $serializer */
                $serializer = Yii::createObject(\krok\configure\serializers\SerializerInterface::class);

                return new \krok\configure\Configure($configurable, $serializer);
            },
        ],
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
        'glide' => [
            'class' => \yii\base\Module::class,
            'controllerNamespace' => 'krok\glide\controllers',
        ],
        'filesystem' => [
            'class' => \yii\base\Module::class,
            'controllerNamespace' => 'krok\filesystem\controllers',
        ],
    ],
    'components' => [
        'authManager' => [
            'class' => \yii\rbac\DbManager::class,
            'cache' => 'cache',
        ],
        'formatter' => [
            'class' => \yii\i18n\Formatter::class,
            'timeZone' => 'Europe/Moscow',
            'numberFormatterSymbols' => [
                \NumberFormatter::CURRENCY_SYMBOL => 'руб.',
            ],
            'numberFormatterOptions' => [
                \NumberFormatter::MAX_FRACTION_DIGITS => 2,
            ],
        ],
        'security' => [
            'class' => \yii\base\Security::class,
            'passwordHashCost' => 15,
        ],
        'session' => [
            'class' => \yii\web\CacheSession::class,
            'timeout' => 24 * 60 * 60,
            'cache' => [
                'class' => \yii\redis\Cache::class,
                'defaultDuration' => 0,
                'keyPrefix' => hash('crc32', __FILE__),
                'redis' => [
                    'hostname' => getenv('REDIS_HOST'),
                    'port' => getenv('REDIS_PORT'),
                    'database' => 1,
                ],
            ],
        ],
        'cache' => [
            'class' => \yii\redis\Cache::class,
            'defaultDuration' => 24 * 60 * 60,
            'keyPrefix' => hash('crc32', __FILE__),
            'redis' => [
                'hostname' => getenv('REDIS_HOST'),
                'port' => getenv('REDIS_PORT'),
                'database' => 0,
            ],
        ],
        'mailer' => [
            'class' => \yii\swiftmailer\Mailer::class,
            'transport' => [
                'class' => \Swift_SmtpTransport::class,
                'host' => getenv('SMTP_HOST'),
                'username' => getenv('SMTP_USERNAME'),
                'password' => getenv('SMTP_PASSWORD'),
                'port' => getenv('SMTP_PORT'),
                'encryption' => getenv('SMTP_ENCRYPTION'),
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
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                'file' => [
                    'class' => \krok\log\FileTarget::class,
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
        'queue' => [
            'class' => \yii\queue\redis\Queue::class,
            'redis' => [
                'hostname' => getenv('REDIS_HOST'),
                'port' => getenv('REDIS_PORT'),
                'database' => 2,
            ],
        ],
        'db' => require(__DIR__ . DIRECTORY_SEPARATOR . 'db.php'),
    ],
    'params' => require(__DIR__ . DIRECTORY_SEPARATOR . 'params.php'),
],
    is_readable(__DIR__ . DIRECTORY_SEPARATOR . 'local.php') ? require(__DIR__ . DIRECTORY_SEPARATOR . 'local.php') : []);
