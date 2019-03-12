<?php

return [
    'class' => \yii\db\Connection::class,
    'dsn' => 'mysql:host=' . env('MYSQL_HOST') . ';dbname=' . env('MYSQL_DATABASE') . ';port=' . env('MYSQL_PORT'),
    'username' => env('MYSQL_USER'),
    'password' => env('MYSQL_PASSWORD'),
    'charset' => 'utf8',
    'tablePrefix' => 'cmf2_',
    'enableQueryCache' => true,
    'queryCacheDuration' => 1 * 60 * 60, // seconds
    'enableSchemaCache' => YII_ENV_PROD,
    'schemaCacheDuration' => 1 * 60 * 60, // seconds
];
