<?php

$config = [
    'id' => 'console',
    'bootstrap' => [
        'queue',
    ],
    'controllerMap' => [
        'migrate' => [
            'class' => \yii\console\controllers\MigrateController::class,
            'migrationTable' => '{{%migration}}',
            'useTablePrefix' => true,
            'interactive' => false,
            'migrationPath' => [
                '@app/migrations',
                '@yii/rbac/migrations',
                '@app/modules/auth/migrations',
                '@krok/storage/migrations',
                '@krok/content/migrations',
                '@krok/configure/migrations',
            ],
        ],
        'access' => [
            'class' => \krok\access\AccessController::class,
            'userIds' => [
                1,
            ],
            'rules' => [
                \app\modules\auth\rbac\AuthorRule::class,
            ],
            'config' => [
                [
                    'name' => 'system',
                    'controllers' => [
                        'default' => [
                            'index',
                            'flush-cache',
                        ],
                    ],
                ],
                [
                    'name' => 'tinymce/uploader',
                    'controllers' => [
                        'default' => [
                            'image',
                            'file',
                        ],
                    ],
                ],
                [
                    'name' => 'auth',
                    'controllers' => [
                        'auth' => [
                            'index',
                            'create',
                            'update',
                            'delete',
                            'view',
                            'refresh-token',
                        ],
                        'log' => ['index'],
                        'social' => ['index'],
                        'profile' => ['index'],
                    ],
                ],
                [
                    'name' => 'content',
                    'controllers' => [
                        'default' => [],
                    ],
                ],
                [
                    'name' => 'backup',
                    'controllers' => [
                        'default' => [
                            'index',
                        ],
                        'make' => [
                            'filesystem',
                            'database',
                        ],
                        'download' => [
                            'filesystem',
                            'database',
                        ],
                    ],
                ],
                [
                    'name' => 'configure',
                    'controllers' => [
                        'default' => [
                            'list',
                            'save',
                        ],
                    ],
                ],
            ],
        ],
    ],
    'modules' => [],
    'components' => [
        'urlManager' => [
            'class' => \yii\di\ServiceLocator::class,
            'components' => [
                'default' => require(__DIR__ . DIRECTORY_SEPARATOR . 'frontend' . DIRECTORY_SEPARATOR . 'urlManager.php'),
                'backend' => require(__DIR__ . DIRECTORY_SEPARATOR . 'backend' . DIRECTORY_SEPARATOR . 'urlManager.php'),
            ],
        ],
        'errorHandler' => [
            'class' => \krok\sentry\console\SentryErrorHandler::class,
            'sentry' => \krok\sentry\Sentry::class,
        ],
    ],
];

return \yii\helpers\ArrayHelper::merge(require(__DIR__ . DIRECTORY_SEPARATOR . 'common.php'), $config);
