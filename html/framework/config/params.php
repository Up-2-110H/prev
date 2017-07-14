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
            'label' => 'Users',
            'icon' => 'ti-panel',
            'items' => [
                [
                    'label' => 'Auth',
                    'icon' => 'ti-user',
                    'url' => ['/auth'],
                ],
                [
                    'label' => 'Social network',
                    'icon' => 'ti-sharethis',
                    'url' => ['/auth/social/index'],
                ],
                [
                    'label' => 'Log',
                    'icon' => 'ti-book',
                    'url' => ['/auth/log/index'],
                ],
            ],
        ],
        [
            'label' => 'Content',
            'icon' => 'ti-files',
            'items' => [
                [
                    'label' => 'Example',
                    'icon' => 'ti-files',
                    'url' => ['/example/example'],
                ],
            ],
        ],
        [
            'label' => 'System',
            'icon' => 'ti-settings',
            'items' => [
                [
                    'label' => 'Clear cache',
                    'icon' => 'ti-reload',
                    'url' => ['/system/default/flush-cache'],
                ],
            ],
        ],
    ],
];
