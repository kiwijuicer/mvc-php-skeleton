<?php
declare (strict_types = 1);

namespace Core\Mvc;

use Core\Log\Logger;

/**
 * Application
 *
 * @package Core\Mvc
 * @author Norbert Hanauer <norbert.hanauer@check24.de>
 * @copyright CHECK24 Vergleichsportal GmbH
 */
class Application
{
    /**
     * Config
     *
     * @var array
     */
    protected static $config;

    /**
     * Dependecy Manager
     *
     * @var \Core\Mvc\DependencyManager
     */
    protected static $dependencyManager;

    /**
     * Inits application with dependency manager and returns instance of itself
     *
     * @param array $configs
     * @return \Core\Mvc\Application
     */
    public static function init(array $configs): self
    {
        session_start();

        self::$config = array_merge(...$configs);

        self::$dependencyManager = new DependencyManager(self::$config['dependencies'] ?? []);

        Error::setErrorHandler(self::$dependencyManager->get(Logger::LOGGER_PHP));
        Error::setExceptionHandler(self::$dependencyManager->get(Logger::LOGGER_EXCEPTION));

        return new self();
    }

    /**
     * Returns dependency manager
     *
     * @return \Core\Mvc\DependencyManager
     */
    public static function getDependencyManager(): DependencyManager
    {
        return self::$dependencyManager;
    }

    /**
     * Returns config
     *
     * @return array
     */
    public static function getConfig(): array
    {
        return self::$config;
    }

    /**
     * Runs the application
     *
     * @var void
     */
    public function run(): void
    {
        $router = new Router();

        $route = $router->match(self::getDependencyManager()->get(Request::class));

        $router->routeTo($route);
    }
}
