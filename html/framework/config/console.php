<?php

$config = [
    'id' => 'console',
    'controllerMap' => [
        // Migrations for the specific project's module
        'migrate' => [
            'class' => 'app\commands\MigrateController',
            'migrationTable' => '{{%migration}}',
            'paths' => [
                '@yii/rbac/migrations',
                '@app/migrations',
                '@app/modules/auth/migrations',
            ],
        ],
        'access' => [
            'class' => 'app\commands\AccessController',
            'login' => [
                'webmaster',
            ],
            'rules' => [
                'app\modules\auth\rbac\AuthorRule',
            ],
            'user' => 'app\modules\auth\models\Auth',
            'modules' => [
                [
                    'name' => '',
                    'controllers' => [
                        'default' => [
                            'index',
                            'flush-cache',
                            'flush-assets',
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
