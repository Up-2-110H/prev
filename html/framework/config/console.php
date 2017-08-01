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
                '@yii/rbac/migrations',
                '@app/migrations',
                '@app/modules/auth/migrations',
                '@app/modules/example/migrations',
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
                    'name' => 'auth',
                    'controllers' => [
                        'auth' => [],
                        'log' => ['index'],
                        'social' => ['index'],
                    ],
                ],
                [
                    'name' => 'example',
                    'controllers' => [
                        'example' => [],
                    ],
                ],
            ],
        ],
    ],
    'components' => [
        'urlManager' => [
            'baseUrl' => '/',
            'hostInfo' => '/',
        ],
    ],
];

return \yii\helpers\ArrayHelper::merge(require(__DIR__ . DIRECTORY_SEPARATOR . 'common.php'), $config);
