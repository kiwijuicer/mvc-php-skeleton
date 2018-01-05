<?php
declare (strict_types = 1);

chdir(dirname(__DIR__));

require __DIR__ . '/../vendor/autoload.php';

\KiwiJuicer\Mvc\Application::init(
    \KiwiJuicer\Mvc\ConfigProvider::merge([
    __DIR__ . '/../config/config.php',
    __DIR__ . '/../config/routes.php',
    __DIR__ . '/../config/config.local.php'
    ])
)->run();
