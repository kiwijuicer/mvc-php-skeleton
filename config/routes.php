<?php
declare (strict_types = 1);

return [

    'routes' => [

        'index' => [

            'path' => '/',
            'controller' => \App\Controller\IndexController::class,
            'action' => 'index',
            'auth' => true
        ],

        'login' => [

            'path' => '/login',
            'controller' => \App\Controller\AuthenticationController::class,
            'action' => 'login',
            'auth' => false
        ],

        'logout' => [

            'path' => '/logout',
            'controller' => \App\Controller\AuthenticationController::class,
            'action' => 'logout',
            'auth' => false
        ],

        'users' => [

            'path' => '/users',
            'controller' => \App\Controller\UserController::class,
            'action' => 'index',
            'auth' => true
        ],

        'user-new' => [

            'path' => '/users/new',
            'controller' => \App\Controller\UserController::class,
            'action' => 'edit',
            'auth' => true
        ],

        'user-edit' => [

            'path' => '/users/edit',
            'controller' => \App\Controller\UserController::class,
            'action' => 'edit',
            'auth' => true
        ]
    ]
];
