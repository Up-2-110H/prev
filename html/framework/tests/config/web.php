<?php
/**
 * Created by PhpStorm.
 * User: elfuvo
 * Date: 30.05.18
 * Time: 14:27
 */

$baseDir = __DIR__ . '/../../config';

$config = require($baseDir . '/frontend.php');
$config['components']['urlManager'] = require($baseDir . '/frontend/urlManager.php');
$config['components']['user'] = [
    'class' => \yii\web\User::class,
    'identityClass' => \app\tests\User::class,
    'enableAutoLogin' => false,
];
$config['components']['db'] = require('db.php');

$config['aliases']['@public'] = __DIR__ . '/../_output';
$config['aliases']['@runtime'] = __DIR__ . '/../_output';

return $config;
