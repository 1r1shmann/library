<?php

use yii\bootstrap5\NavBar;
use app\components\MenuHelper;
use yii\bootstrap5\Html;

NavBar::begin([
    'brandLabel' => Yii::$app->name,
    'brandUrl' => Yii::$app->homeUrl,
    'options' => ['class' => 'navbar-expand-lg navbar-dark bg-dark']
]);

$menu_items = [
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
        'label' => 'Жанры',
        'url' => ['/site/genres']
    ],
    [
        'label' => 'Случайная книга',
        'url' => ['/site/random-book']
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
    [
        'label' => 'Регистрация',
        'url' => ['/site/signup'],
        'visible' => Yii::$app->user->isGuest
    ],
    [
        'label' => 'Войти',
        'url' => ['/site/login'],
        'visible' => Yii::$app->user->isGuest
    ],
];

if (!Yii::$app->user->isGuest) {
    $menu_items[] = [
        'label' => Html::img('@web/images/avatars/' . Yii::$app->user->identity->avatar, ['class' => 'rounded-circle', 'height' => 25, 'loading' => 'lazy']) . ' ' . Yii::$app->user->identity->username,
        'visible' => !Yii::$app->user->isGuest,
        'items' => [
            [
                'label' => 'About',
                'url' => ['/site/about'],
            ],
            [
                'label' => 'Contact',
                'url' => ['/site/contact'],
            ],
            [
                'label' => 'Выйти',
                'url' => ['/site/logout'],
            ]
        ]
    ];
}



echo MenuHelper::widget([
    'encodeLabels' => false,
    'options' => ['class' => 'navbar-nav'],
    'items' => $menu_items
]);
NavBar::end();
