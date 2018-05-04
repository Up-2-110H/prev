<?php

return [
    'email' => getenv('EMAIL'),
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
            'label' => 'Content',
            'icon' => 'ti-files',
            'items' => [
                [
                    'label' => 'Content',
                    'url' => ['/content/default'],
                ],
            ],
        ],
    ],
    'dropdown' => [
        [
            'label' => 'Users',
            'icon' => 'ti-user',
            'items' => [
                [
                    'label' => 'Auth',
                    'url' => ['/auth/auth'],
                ],
                [
                    'label' => 'Social network',
                    'url' => ['/auth/social'],
                ],
                [
                    'label' => 'Log',
                    'url' => ['/auth/log'],
                ],
            ],
        ],
        [
            'label' => 'Systemic',
            'icon' => 'ti-settings',
            'items' => [
                [
                    'label' => 'Configure',
                    'url' => ['/configure'],
                ],
                [
                    'label' => 'Clear cache',
                    'url' => ['/system/default/flush-cache'],
                ],
                [
                    'label' => 'Backup Manager',
                    'url' => ['/backupManager/default'],
                ],
            ],
        ],
    ],
];
