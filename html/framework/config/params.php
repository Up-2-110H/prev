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
                [
                    'label' => 'Logging',
                    'url' => ['/logging/default'],
                ],
                [
                    'label' => 'Example',
                    'url' => ['/example/default'],
                ],
                [
                    'label' => 'Backup Manager',
                    'url' => ['/backupManager/default'],
                ],
            ],
        ],
    ],
];
