<?php

return [
    'email' => 'webmaster@dev-vps.ru',
    'HTMLPurifier' => [
        'Attr.AllowedFrameTargets' => [
            '_blank',
            '_self',
            '_parent',
            '_top',
        ],
        'HTML.Trusted' => true,
        'Filter.YouTube' => true,
    ],
    'menu' => [
        [
            'label' => 'Пользователи',
            'icon' => 'ti-panel',
            'items' => [
                [
                    'label' => 'Авторизация',
                    'icon' => 'ti-user',
                    'url' => ['/auth'],
                ],
                [
                    'label' => 'Социальные сети',
                    'icon' => 'ti-sharethis',
                    'url' => ['/auth/social/index'],
                ],
                [
                    'label' => 'Журнал',
                    'icon' => 'ti-book',
                    'url' => ['/auth/log/index'],
                ],
            ],
        ],
        [
            'label' => 'Системные',
            'icon' => 'ti-settings',
            'items' => [
                [
                    'label' => 'Очистить кэш',
                    'icon' => 'ti-reload',
                    'url' => ['/system/default/flush-cache'],
                ],
                [
                    'label' => 'Очистить ресурсы',
                    'icon' => 'ti-trash',
                    'url' => ['/system/default/flush-assets'],
                ],
            ],
        ],
    ],
];
