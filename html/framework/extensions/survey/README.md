Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist yii2-developer/yii2-survey "*"
```

or add

```
"yii2-developer/yii2-survey": "*"
```

to the require section of your `composer.json` file.

backend:

```
    'modules' => [
        'survey' => [
            'class' => \krok\survey\Module::class,
            'viewPath' => '@krok/survey/views/backend',
            'controllerNamespace' => 'krok\survey\controllers\backend',
            'defaultRoute' => 'survey',
        ],
    ],
```

frontend:

```
    'modules' => [
        'survey' => [
            'class' => \krok\survey\Module::class,
            'viewPath' => '@krok/survey/views/frontend',
            'controllerNamespace' => 'krok\survey\controllers\frontend',
        ],
    ],
```

console:

```
    'controllerMap' => [
        'migrate' => [
            'class' => \yii\console\controllers\MigrateController::class,
            'migrationTable' => '{{%migration}}',
            'useTablePrefix' => true,
            'interactive' => false,
            'migrationPath' => [
                '@krok/survey/migrations',
            ],
        ],

        ...

        'access' => [
            'class' => \krok\access\AccessController::class,
            'userIds' => [
                1,
            ],
            'rules' => [
                \krok\auth\rbac\AuthorRule::class,
            ],
            'config' => [
                [
                    'label' => 'Survey',
                    'name' => 'survey',
                    'controllers' => [
                        'survey' => [
                            'label' => 'Survey',
                            'actions' => [],
                        ],
                        'question' => [
                            'label' => 'Question',
                            'actions' => [
                                'index',
                                'textarea',
                                'numeric',
                                'radio',
                                'checkbox',
                                'select',
                                'select-multiple',
                                'view',
                                'update',
                                'delete',
                                'update-all',
                            ],
                        ],
                        'answer' => [
                            'label' => 'Answer',
                            'actions' => [
                                'index',
                                'create',
                                'view',
                                'update',
                                'delete',
                                'update-all',
                            ],
                        ],
                    ],
                ],
            ],
        ],
    ],
```

params:

```
    'menu' => [
        [
            'label' => 'Survey',
            'items' => [
                [
                    'label' => 'Survey',
                    'url' => ['/survey'],
                ],
            ],
        ],
    ],
```
