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
                    'url' => ['/auth'],
                ],
                [
                    'label' => 'Social network',
                    'url' => ['/auth/social/index'],
                ],
                [
                    'label' => 'Log',
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
                    'url' => ['/system/default/flush-cache'],
                ],
            ],
        ],
    ],
];
