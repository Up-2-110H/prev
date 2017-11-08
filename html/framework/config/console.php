<?php

$config = [
    'id' => 'console',
    'controllerMap' => [
        // Migrations for the specific project's module
        'migrate' => [
            'class' => \yii\console\controllers\MigrateController::class,
            'migrationTable' => '{{%migration}}',
            'interactive' => false,
            'migrationPath' => [
                '@app/migrations',
                '@yii/rbac/migrations',
                '@app/modules/auth/migrations',
                '@vendor/yii2-developer/yii2-logging/migrations',
                '@vendor/yii2-developer/yii2-storage/migrations',
                '@vendor/yii2-developer/yii2-content/migrations',
                '@vendor/yii2-developer/yii2-example/migrations',
            ],
        ],
        'access' => [
            'class' => \app\commands\AccessController::class,
            'login' => [
                'webmaster',
            ],
            'rules' => [
                \app\modules\auth\rbac\AuthorRule::class,
            ],
            'user' => \app\modules\auth\models\Auth::class,
            'modules' => [
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
                    'name' => 'logging',
                    'controllers' => [
                        'default' => [
                            'index',
                            'view',
                        ],
                    ],
                ],
                [
                    'name' => 'imperavi',
                    'controllers' => [
                        'default' => [
                            'file-upload',
                            'file-list',
                            'image-upload',
                            'image-list',
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
                    'name' => 'example',
                    'controllers' => [
                        'example' => [],
                    ],
                ],
                [
                    'name' => 'backupManager',
                    'controllers' => [
                        'default' => [
                            'index',
                            'download',
                        ],
                        'database' => [
                            'backup',
                        ],
                        'filesystem' => [
                            'backup',
                        ],
                    ],
                ],
            ],
        ],
    ],
    'modules' => [],
    'components' => [
        'urlManager' => [
            'baseUrl' => '/',
            'hostInfo' => '/',
            'rules' => require(__DIR__ . DIRECTORY_SEPARATOR . 'frontend' . DIRECTORY_SEPARATOR . 'rules.php'),
        ],
    ],
];

return \yii\helpers\ArrayHelper::merge(require(__DIR__ . DIRECTORY_SEPARATOR . 'common.php'), $config);
