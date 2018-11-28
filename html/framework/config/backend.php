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
            'default-src \'none\'; script-src \'self\' \'unsafe-inline\' \'unsafe-eval\'; connect-src \'self\' speller.yandex.net; child-src \'self\'; img-src * data: blob:; style-src * \'unsafe-inline\'; font-src * data:;');
    },
    'container' => [
        'definitions' => [
            \yii\captcha\CaptchaAction::class => [
                'transparent' => true,
            ],
            \yii\grid\ActionColumn::class => [
                'header' => 'Действие',
                'options' => [
                    'width' => 150,
                ],
            ],
            \krok\extend\grid\DatePickerColumn::class => [
                'format' => 'datetime',
            ],
            \krok\extend\grid\DatetimePickerColumn::class => [
                'dateFormat' => 'Y-m-d H:i',
            ],
            \krok\flatpickr\FlatpickrDatetimeWidget::class => [
                'class' => \krok\datetimeFormatter\FlatpickrDatetimeWidget::class,
                'dateFormat' => 'Y-m-d H:i',
                'defaultDatetime' => true,
            ],
            \krok\flatpickr\FlatpickrDateWidget::class => \krok\datetimeFormatter\FlatpickrDateWidget::class,
            \krok\flatpickr\FlatpickrTimeWidget::class => \krok\datetimeFormatter\FlatpickrTimeWidget::class,
            \krok\datetimeFormatter\validators\DatetimeFormatterValidator::class => [
                'timestampAttributeFormat' => 'yyyy-MM-dd HH:mm',
            ],
            \krok\editor\EditorWidget::class => \krok\tinymce\TinyMceWidget::class,
            \krok\tinymce\TinyMceWidget::class => [
                'clientOptions' => [
                    'branding' => false,
                    'menubar' => false,
                    'language' => 'ru',
                    'height' => 600,
                    'plugins' => [
                        'advlist',
                        'anchor',
                        'charmap',
                        'code',
                        'textcolor',
                        'colorpicker',
                        'media',
                        'image',
                        'hr',
                        'insertdatetime',
                        'link',
                        'lists',
                        'nonbreaking',
                        'paste',
                        'print',
                        'searchreplace',
                        'spellchecker',
                        'table',
                        'template',
                        'visualblocks',
                        'visualchars',
                        // passive
                        'autolink',
                        'contextmenu',
                        'imagetools',
                        'wordcount',
                    ],
                    'external_plugins' => [
                        'easyfileupload' => 'easyfileupload',
                    ],
                    'toolbar1' => implode(' | ', [
                        'formatselect fontselect fontsizeselect',
                    ]),
                    'toolbar2' => implode(' | ', [
                        'bold italic underline strikethrough',
                        'subscript superscript',
                        'alignleft aligncenter alignright alignjustify',
                        'outdent indent',
                        'forecolor backcolor',
                    ]),
                    'toolbar3' => implode(' | ', [
                        'searchreplace',
                        'cut copy paste',
                        'table',
                        'numlist bullist',
                        'link unlink',
                        'easyfileupload image media',
                        'hr',
                        'blockquote',
                        'insertdatetime',
                        'anchor',
                        'charmap',
                        'nonbreaking',
                        'template',
                    ]),
                    'toolbar4' => implode(' | ', [
                        'code',
                        'undo redo',
                        'visualblocks visualchars',
                        'removeformat',
                        'spellchecker',
                        'print',
                    ]),
                    'relative_urls' => false,
                    'images_upload_url' => '/cp/tinymce/uploader/default/image',
                    'easyfileupload_url' => '/cp/tinymce/uploader/default/file',
                    'insertdatetime_formats' => [
                        '%H:%M',
                        '%d.%m.%Y',
                    ],
                    'templates' => [
                        [
                            'title' => 'NSign',
                            'description' => 'NSign',
                            'content' => '<a href="http://www.nsign.ru" target="_blank">NSign</a>',
                        ],
                    ],
                    'spellchecker_languages' => 'Russian=ru,English=en',
                    'spellchecker_language' => 'ru',
                    'spellchecker_rpc_url' => '//speller.yandex.net/services/tinyspell',
                ],
            ],
            \krok\backup\actions\FilesystemJobAction::class => function (
                \yii\di\Container $container,
                array $configure
            ) {
                [$id, $controller] = $configure;

                /** @var \krok\BackupManager\FilesystemManager $manager */
                $manager = $container->get(\krok\BackupManager\FilesystemManager::class);

                $action = new \krok\backup\actions\FilesystemJobAction($id, $controller, $manager);

                $action->destinations = [
                    new \BackupManager\Filesystems\Destination('filesystem',
                        (new DateTime())->format('Y-m-d_H:i:s') . '.zip'),
                ];

                return $action;
            },
            \krok\backup\actions\DatabaseJobAction::class => function (
                \yii\di\Container $container,
                array $configure
            ) {
                [$id, $controller] = $configure;

                /** @var \krok\BackupManager\DatabaseManager $manager */
                $manager = $container->get(\krok\BackupManager\DatabaseManager::class);

                $action = new \krok\backup\actions\DatabaseJobAction($id, $controller, $manager);

                $action->destinations = [
                    new \BackupManager\Filesystems\Destination('database',
                        (new DateTime())->format('Y-m-d_H:i:s') . '.sql'),
                ];

                return $action;
            },
            \krok\BackupManager\Finders\FinderProvider::class => function () {
                $finder = new \krok\BackupManager\Finders\FinderProvider(new \BackupManager\Config\Config([
                    'symfony' => [
                        'type' => 'symfony',
                        'exclude' => [
                            'web/cp/assets',
                            'web/assets',
                            'storage',
                            'backup',
                        ],
                        'root' => Yii::getAlias('@root'),
                    ],
                ]));
                $finder->add(new \krok\BackupManager\Finders\SymfonyFinder());

                return $finder;
            },
            \BackupManager\Databases\DatabaseProvider::class => function () {
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

                return $databases;
            },
            \BackupManager\Filesystems\FilesystemProvider::class => function () {
                $filesystems = new \BackupManager\Filesystems\FilesystemProvider(new \BackupManager\Config\Config([
                    'local' => [
                        'type' => 'Local',
                        'root' => Yii::getAlias('@backup/tmp'),
                    ],
                    'filesystem' => [
                        'type' => 'Local',
                        'root' => Yii::getAlias('@backup/filesystem'),
                    ],
                    'database' => [
                        'type' => 'Local',
                        'root' => Yii::getAlias('@backup/database'),
                    ],
                ]));
                $filesystems->add(new \BackupManager\Filesystems\LocalFilesystem());

                return $filesystems;
            },
            \BackupManager\Compressors\CompressorProvider::class => function () {
                $compressors = new \BackupManager\Compressors\CompressorProvider();
                $compressors->add(new \BackupManager\Compressors\GzipCompressor());

                return $compressors;
            },
        ],
    ],
    'modules' => [
        'system' => [
            'class' => \krok\system\Module::class,
            'viewPath' => '@krok/system/views/backend',
            'controllerNamespace' => 'krok\system\controllers\backend',
        ],
        'tinymce' => [
            'class' => \yii\base\Module::class,
            'modules' => [
                'uploader' => [
                    'class' => \yii\base\Module::class,
                    'controllerNamespace' => 'krok\tinymce\uploader\controllers\backend',
                ],
            ],
        ],
        'auth' => [
            'class' => \krok\auth\Module::class,
            'viewPath' => '@krok/auth/views/backend',
            'controllerNamespace' => 'krok\auth\controllers\backend',
        ],
        'content' => [
            'viewPath' => '@krok/content/views/backend',
            'controllerNamespace' => 'krok\content\controllers\backend',
        ],
        'backup' => [
            'class' => \yii\base\Module::class,
            'viewPath' => '@krok/backup/views/backend',
            'controllerNamespace' => 'krok\backup\controllers\backend',
        ],
        'configure' => [
            'class' => \krok\configure\Module::class,
            'viewPath' => '@krok/configure/views/backend',
            'controllerNamespace' => 'krok\configure\controllers\backend',
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
                    '@krok/system/views/backend' => '@app/modules/system/views/backend',
                    '@krok/system/views/backend/layouts' => '@themes/views/layouts',
                ],
            ],
        ],
        'urlManager' => [
            'class' => \yii\di\ServiceLocator::class,
            'components' => [
                'default' => require(__DIR__ . '/backend/urlManager.php'),
                'frontend' => require(__DIR__ . '/frontend/urlManager.php'),
            ],
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
                \krok\paperDashboard\assets\PaperDashboardAsset::class => [
                    'depends' => [
                        \yii\web\JqueryAsset::class,
                        \yii\bootstrap\BootstrapAsset::class,
                        \krok\paperDashboard\assets\BootstrapSelectPickerAsset::class,
                        \krok\paperDashboard\assets\BootstrapSwitchTagsAsset::class,
                        \krok\paperDashboard\assets\Es6PromiseAutoAsset::class,
                        \krok\paperDashboard\assets\PerfectScrollbarAsset::class,
                        \krok\bootbox\BootBoxAsset::class,
                    ],
                ],
            ],
        ],
        'session' => [
            'name' => 'PHPSESSID-CP',
            'cookieParams' => [
                'httponly' => true,
                'path' => '/cp',
            ],
        ],
        'request' => [
            'class' => \krok\language\Request::class,
            'csrfParam' => '_csrf-CP',
            'csrfCookie' => [
                'httpOnly' => true,
                'path' => '/cp',
            ],
            'cookieValidationKey' => getenv('YII_COOKIE_VALIDATION_KEY'),
        ],
        'authManager' => [
            'class' => \yii\rbac\DbManager::class,
            'cache' => 'cache',
        ],
        'user' => [
            'class' => \krok\auth\components\User::class,
            'identityClass' => \krok\auth\models\Auth::class,
            'loginUrl' => ['/auth/default/login'],
            'on afterLogin' => function (\yii\web\UserEvent $event) {
                \krok\catchAll\UserHandler::loginHandle();
                \krok\auth\components\UserEventHandler::handleAfterLogin($event);
            },
            'on afterLogout' => function (\yii\web\UserEvent $event) {
                \krok\catchAll\UserHandler::logoutHandle();
                \krok\auth\components\UserEventHandler::handleAfterLogout($event);
            },
        ],
        'authClientCollection' => [
            'class' => \yii\authclient\Collection::class,
            'clients' => [
                'yandex' => [
                    'class' => \krok\oauth\Yandex::class,
                    'clientId' => '',
                    'clientSecret' => '',
                    'normalizeUserAttributeMap' => [
                        'email' => 'default_email',
                    ],
                ],
                'google' => [
                    'class' => \krok\oauth\Google::class,
                    'clientId' => '',
                    'clientSecret' => '',
                    'normalizeUserAttributeMap' => [
                        'login' => ['emails', 0, 'value'],
                        'email' => ['emails', 0, 'value'],
                    ],
                ],
                'vkontakte' => [
                    'class' => \krok\oauth\VKontakte::class,
                    'clientId' => '',
                    'clientSecret' => '',
                    'normalizeUserAttributeMap' => [
                        'id' => 'user_id',
                        'login' => 'screen_name',
                    ],
                ],
                'facebook' => [
                    'class' => \krok\oauth\Facebook::class,
                    'clientId' => '',
                    'clientSecret' => '',
                    'normalizeUserAttributeMap' => [
                        'login' => 'id',
                    ],
                ],
                'twitter' => [
                    'class' => \krok\oauth\TwitterOAuth2::class,
                    'clientId' => '',
                    'clientSecret' => '',
                    'normalizeUserAttributeMap' => [
                        'login' => 'screen_name',
                    ],
                ],
                'gitlab' => [
                    'class' => \krok\oauth\GitLab::class,
                    'clientId' => '',
                    'clientSecret' => '',
                    'normalizeUserAttributeMap' => [
                        'login' => 'username',
                    ],
                ],
                'ok' => [
                    'class' => \krok\oauth\Ok::class,
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
            'class' => \krok\sentry\web\SentryErrorHandler::class,
            'errorAction' => 'system/default/error',
            'sentry' => \krok\sentry\Sentry::class,
        ],
    ],
];

if (YII_ENV_DEV) {
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => \yii\debug\Module::class,
        'panels' => [
            'config' => false,
            'request' => [
                'class' => \yii\debug\panels\RequestPanel::class,
                'displayVars' => ['_GET', '_POST', '_COOKIE', '_SESSION', '_FILES'],
            ],
            'log' => [
                'class' => \yii\debug\panels\LogPanel::class,
            ],
            'profiling' => [
                'class' => \yii\debug\panels\ProfilingPanel::class,
            ],
            'db' => [
                'class' => \yii\debug\panels\DbPanel::class,
            ],
            'assets' => [
                'class' => \yii\debug\panels\AssetPanel::class,
            ],
            'mail' => [
                'class' => \yii\debug\panels\MailPanel::class,
            ],
            'timeline' => [
                'class' => \yii\debug\panels\TimelinePanel::class,
            ],
            'user' => [
                'class' => \yii\debug\panels\UserPanel::class,
            ],
            'router' => [
                'class' => \yii\debug\panels\RouterPanel::class,
            ],
            'queue' => [
                'class' => \yii\queue\debug\Panel::class,
            ],
        ],
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
            'job' => [
                'class' => \yii\queue\gii\Generator::class,
            ],
        ],
        'allowedIPs' => [
            '127.0.0.1',
            '::1',
            '172.72.*.*',
        ],
    ];
}

return \yii\helpers\ArrayHelper::merge(require(__DIR__ . '/common.php'), $config);
