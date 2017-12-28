<?php
declare (strict_types = 1);

use Core\Log;

return [

    'env' => 'production',

    'base-url' => 'http://mvc.dev.norbert.c24',

    'dependencies' => [

        'invokables' => [

        ],

        'factories' => [
            \App\Controller\AuthenticationController::class => \App\Controller\Factory\AuthenticationControllerFactory::class,
            \App\Controller\IndexController::class => \App\Controller\Factory\IndexControllerFactory::class,
            \App\Controller\UserController::class => \App\Controller\Factory\UserControllerFactory::class
        ],

        'managers' => [

            \Core\Manager\UserManager::class => [
                'manager' => \Core\Manager\UserManager::class,
                'entity' => \Core\Entity\User::class,
                'db' => 'mvc'
            ]
        ],

        'log' => [
            Log\Logger::LOGGER_PHP => [
                'writers' => [
                    Log\FileWriter::class => [
                        'path' => 'logs/php.log'
                    ]
                ]
            ],
            Log\Logger::LOGGER_EXCEPTION => [
                'writers' => [
                    Log\FileWriter::class => [
                        'path' => 'logs/exception.log'
                    ]
                ]
            ],
            Log\Logger::LOGGER_APP => [
                'writers' => [
                    Log\FileWriter::class => [
                        'path' => 'logs/app.log'
                    ]
                ]
            ]
        ]
    ],

    'db' => [
        'mvc' => [
            'dsn'            => 'mysql:dbname=mvc;host=127.0.0.1;port=3306;charset=utf8',
            'driver'         => 'Pdo',
            'username'       => 'mvc-user',
            'password'       => 'Okifofogu695',
            'driver_options' => [
                PDO::MYSQL_ATTR_COMPRESS    => false,
                PDO::ATTR_EMULATE_PREPARES  => false,
                PDO::ATTR_STRINGIFY_FETCHES => false
            ]
        ]
    ],

    'view-manager' => [
        'public'        => __DIR__ . '/../public',
        'layout'        => __DIR__ . '/../App/src/view/layout/layout.phtml',
        'path-stack'    => [
    '       app' => __DIR__ . '/../App/src/view/'
        ],
        'templates' => [
            'error-500' => __DIR__ . '/../App/src/view/500.phtml',
            'error-404' => __DIR__ . '/../App/src/view/404.phtml'
        ],
        'inject' => [
            'headTitle' => 'Mvc'
        ]
    ]
];
