<?php

array_map(function ($env) {
    $path = dirname(dirname(__DIR__));

    if (file_exists($path . '/' . $env)) {
        $factory = new \Dotenv\Environment\DotenvFactory([
            new \krok\env\StaticAdapter(
                new \krok\env\Environment()
            ),
        ]);

        \Dotenv\Dotenv::create($path, $env, $factory)->overload();
    }
}, [
    '.env',
    '.env.local',
]);

defined('YII_DEBUG') or define('YII_DEBUG', env('YII_DEBUG') === 'true');
defined('YII_ENV') or define('YII_ENV', env('YII_ENV') ?: 'prod');
