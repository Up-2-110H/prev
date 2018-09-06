Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist yii2-developer/yii2-news "*"
```

or add

```
"yii2-developer/yii2-news": "*"
```

to the require section of your `composer.json` file.

Use:
====

backend:

```
    'modules' => [
        'news' => [
            'class' => \krok\news\Module::class,
            'viewPath' => '@krok/news/views/backend',
            'controllerNamespace' => 'krok\news\controllers\backend',
        ],
    ],
```

common:

```
    'container' => [
        'singletons' => [
            \krok\configure\ConfigureInterface::class => function () {
                $configurable = [
                    \krok\news\Configure::class,
                ];

                /** @var \krok\configure\serializers\SerializerInterface $serializer */
                $serializer = Yii::createObject(\krok\configure\serializers\SerializerInterface::class);

                return new \krok\configure\Configure($configurable, $serializer);
            },
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
                '@krok/news/migrations',
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
                    'label' => 'News',
                    'name' => 'news',
                    'controllers' => [
                        'default' => [
                            'label' => 'News',
                            'actions' => [],
                        ],
                        'group' => [
                            'label' => 'News Group',
                            'actions' => [],
                        ],
                    ],
                ],
            ],
        ],
    ],
```

frontend:

```
    'modules' => [
        'news' => [
            'class' => \krok\news\Module::class,
            'viewPath' => '@krok/news/views/frontend',
            'controllerNamespace' => 'krok\news\controllers\frontend',
        ],
    ],
```

params:

```
    'menu' => [
        [
            'label' => 'Material',
            'icon' => 'ti-files',
            'items' => [
                [
                    'label' => 'News',
                    'icon' => 'ti-files',
                    'items' => [
                        [
                            'label' => 'News',
                            'url' => ['/news/default'],
                        ],
                        [
                            'label' => 'News Group',
                            'url' => ['/news/group'],
                        ],
                    ],
                ],
            ],
        ],
    ],
```
