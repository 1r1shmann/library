<?php
return [
    'adminEmail' => 'admin@example.com',
    'senderEmail' => 'noreply@example.com',
    'senderName' => 'Example.com mailer',
    'menu_items' => [
        [
            'label' => 'Главная',
            'url' => ['/site/index']
        ],
        [
            'label' => 'About',
            'url' => ['/site/about']
        ],
        [
            'label' => 'Contact',
            'url' => ['/site/contact']
        ],
        [
            'label' => 'Администрирование',
            'restricted' => ['Admin'],
            'items' => [
                [
                    'label' => 'About',
                    'url' => ['/site/about'],
                    'restricted' => ['Admin'],
                ],
                [
                    'label' => 'Contact',
                    'url' => ['/site/contact'],
                    'restricted' => ['Admin'],
                ],
            ]
        ],
    ]
];
