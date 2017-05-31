<?php

return [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=localhost;dbname=dbname', // MySQL, MariaDB
    'username' => 'username',
    'password' => 'password',
    'charset' => 'utf8',
    'tablePrefix' => 'cmf2_',
    'enableQueryCache' => true,
    'queryCacheDuration' => 1 * 60 * 60, // seconds
    'enableSchemaCache' => YII_ENV_PROD,
    'schemaCacheDuration' => 1 * 60 * 60, // seconds
];
