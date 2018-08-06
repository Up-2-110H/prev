<?php

if (file_exists(dirname(dirname(dirname(__DIR__))) . '/.env')) {
    $dotEnv = new \Dotenv\Dotenv(dirname(dirname(dirname(__DIR__))), '.env');
    $dotEnv->load();
}

defined('YII_DEBUG') or define('YII_DEBUG', getenv('YII_DEBUG') === 'true');
defined('YII_ENV') or define('YII_ENV', getenv('YII_ENV') ?: 'prod');
