<?php
/**
 * Created by PhpStorm.
 * User: krok
 * Date: 06.08.18
 * Time: 15:25
 */

return [
    'class' => \yii\db\Connection::class,
    'dsn' => 'mysql:host=' . getenv('MYSQL_HOST') . ';dbname=codeception', // MySQL, MariaDB
    'username' => 'root',
    'password' => getenv('MYSQL_ROOT_PASSWORD'),
    'charset' => 'utf8',
    'tablePrefix' => 'codeception_',
    'enableQueryCache' => true,
    'queryCacheDuration' => 1 * 60 * 60, // seconds
    'enableSchemaCache' => false,
    'schemaCacheDuration' => 1 * 60 * 60, // seconds
];
