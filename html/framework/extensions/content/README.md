Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist yii2-developer/yii2-content "*"
```

or add

```
"yii2-developer/yii2-content": "*"
```

to the require section of your `composer.json` file.

Configure
---------

Make file:

@app/views/layouts/index.php
@app/views/layouts/common.php

@krok/content/views/frontend/default/about.php
@krok/content/views/frontend/default/error.php
@krok/content/views/frontend/default/index.php

frontend/rules.php

```
return [
    '<language:\w+\-\w+>/content/<alias:[\w\-]+>' => 'content/default/index',
];

```

backend.php

```
'modules' => [
    'content' => [
        'viewPath' => '@krok/content/views/backend',
        'controllerNamespace' => 'krok\content\controllers\backend',
    ],
],
```

common.php

```
'modules' => [
    'content' => [
        'class' => \krok\content\Module::class,
        'layouts' => [
            '//index' => 'Главная',
            '//common' => 'Типовая',
        ],
        'views' => [
            'index' => 'Главная',
            'about' => 'О нас',
        ],
    ],
],
```

console.php

```
'migrate' => [
    'class' => \yii\console\controllers\MigrateController::class,
    'migrationTable' => '{{%migration}}',
    'interactive' => false,
    'migrationPath' => [
        '@krok/content/migrations',
    ],
],
```

```
'access' => [
    'class' => \krok\access\AccessController::class,
    'config' => [
        [
            'name' => 'content',
            'controllers' => [
                'default' => [],
            ],
        ],
    ],
],
```

frontend.php

```
'defaultRoute' => 'content/default/index',
```

```
'modules' => [
    'content' => [
        'viewPath' => '@krok/content/views/frontend',
        'controllerNamespace' => 'krok\content\controllers\frontend',
    ],
],
```

```
'errorHandler' => [
    'class' => \yii\web\ErrorHandler::class,
    'errorAction' => 'content/default/error',
],
```
