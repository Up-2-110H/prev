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
