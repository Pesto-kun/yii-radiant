<?php
return [
    'user' => [
        'type' => 1,
        'description' => 'Пользователь',
        'ruleName' => 'userRole',
    ],
    'admin' => [
        'type' => 1,
        'description' => 'Администратор',
        'ruleName' => 'userRole',
        'children' => [
            'user',
        ],
    ],
    'root' => [
        'type' => 1,
        'description' => 'Главный администратор',
        'ruleName' => 'userRole',
        'children' => [
            'admin',
        ],
    ],
];
