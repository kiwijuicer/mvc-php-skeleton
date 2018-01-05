<?php
declare (strict_types = 1);

chdir(dirname(__DIR__));

require __DIR__ . '/../vendor/autoload.php';

\KiwiJuicer\Mvc\Application::init([
    require __DIR__ . '/../config/config.php',
    require __DIR__ . '/../config/routes.php',
    require __DIR__ . '/../config/config.local.php'
])->run();
