<?php

ini_set('session.hash_function', '1');
ini_set('session.hash_bits_per_character', '6');

// comment out the following two lines when deployed to production
defined('YII_DEBUG') or define('YII_DEBUG', false);
defined('YII_ENV') or define('YII_ENV', 'prod');

require(__DIR__ . '/../../framework/vendor/autoload.php');
require(__DIR__ . '/../../framework/vendor/yiisoft/yii2/Yii.php');

$config = require(__DIR__ . '/../../framework/config/backend.php');

(new yii\web\Application($config))->run();
