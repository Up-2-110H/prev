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
        'singletons' => [],
        'definitions' => [
            \krok\storage\behaviors\UploaderBehavior::class => [
                'class' => \krok\storage\behaviors\UploaderBehavior::class,
                'uploadedDirectory' => '/storage',
            ],
            \krok\storage\behaviors\StorageBehavior::class => [
                'class' => \krok\storage\behaviors\StorageBehavior::class,
                'uploadedDirectory' => '/storage',
            ],
            \League\Flysystem\AdapterInterface::class => function () {
                return Yii::createObject(\League\Flysystem\Adapter\Local::class, [Yii::getAlias('@public')]);
            },
            \League\Flysystem\FilesystemInterface::class => function () {
                $filesystem = Yii::createObject(\League\Flysystem\Filesystem::class);
                $filesystem->addPlugin(new \krok\storage\plugins\PublicUrl('/render/storage'));
                $filesystem->addPlugin(new \krok\storage\plugins\HashGrid());

                return $filesystem;
            },
            \League\Glide\ServerFactory::class => function () {
                $server = League\Glide\ServerFactory::create([
                    'source' => Yii::createObject(\League\Flysystem\FilesystemInterface::class),
                    'cache' => Yii::createObject(\League\Flysystem\FilesystemInterface::class),
                    'cache_path_prefix' => 'cache',
                    'driver' => 'imagick',
                ]);
                $server->setResponseFactory(new \krok\glide\response\Yii2ResponseFactory());

                return $server;
            },
            \krok\language\LanguageInterface::class => function () {
                $list = [
                    [
                        'iso' => 'ru-RU',
                        'title' => 'Русский',
                    ],
                    [
                        'iso' => 'en-US',
                        'title' => 'English',
                    ],
                ];

                return Yii::createObject(\krok\language\Language::class, [$list]);
            },
            \krok\backupManager\Manager::class => function () {
                $filesystems = new \BackupManager\Filesystems\FilesystemProvider(new \BackupManager\Config\Config([
                    'local' => [
                        'type' => 'Local',
                        'root' => Yii::getAlias('@runtime/backup/database'), // todo
                    ],
                ]));
                $filesystems->add(new \BackupManager\Filesystems\LocalFilesystem());

                $databases = new \BackupManager\Databases\DatabaseProvider(new \BackupManager\Config\Config([
                    'db' => [
                        'type' => 'mysql',
                        'host' => getenv('MYSQL_HOST'),
                        'port' => 3306,
                        'user' => getenv('MYSQL_USER'),
                        'pass' => getenv('MYSQL_PASSWORD'),
                        'database' => getenv('MYSQL_DATABASE'),
                        'singleTransaction' => true,
                    ],
                ]));
                $databases->add(new \BackupManager\Databases\MysqlDatabase());

                $compressors = new \BackupManager\Compressors\CompressorProvider();
                $compressors->add(new \BackupManager\Compressors\GzipCompressor());

                $finder = (new \Symfony\Component\Finder\Finder())->ignoreUnreadableDirs(true)->ignoreVCS(true)->exclude([
                    'framework/runtime/backup',
                ])->in(dirname(Yii::getAlias('@root')));
                $compressor = new \krok\archiver\compressor\ZipCompressor(['path' => Yii::getAlias('@runtime/backup/filesystem')]);

                return new \krok\backupManager\Manager(
                    new \BackupManager\Manager($filesystems, $databases, $compressors),
                    new \krok\archiver\Manager($finder, $compressor)
                );
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
    ],
    'components' => [
        'authManager' => [
            'class' => \yii\rbac\DbManager::class,
            'cache' => 'cache',
        ],
        'urlManager' => [
            'class' => \krok\language\LanguageUrlManager::class,
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'normalizer' => [
                'class' => \yii\web\UrlNormalizer::class,
            ],
            'rules' => [],
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
                'email' => [
                    'class' => \krok\log\EmailTarget::class,
                    'levels' => [
                        'error',
                        'warning',
                    ],
                    'except' => [
                        'yii\web\HttpException:404',
                        //'yii\web\HttpException:403',
                    ],
                    'message' => [
                        'to' => [
                            'webmaster@dev-vps.ru',
                        ],
                        'from' => [
                            getenv('EMAIL') => 'Logging',
                        ],
                        'subject' => 'CMF2',
                    ],
                    'enabled' => true,
                ],
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
        'db' => require(__DIR__ . DIRECTORY_SEPARATOR . 'db.php'),
    ],
    'params' => require(__DIR__ . DIRECTORY_SEPARATOR . 'params.php'),
],
    is_readable(__DIR__ . DIRECTORY_SEPARATOR . 'local.php') ? require(__DIR__ . DIRECTORY_SEPARATOR . 'local.php') : []);
