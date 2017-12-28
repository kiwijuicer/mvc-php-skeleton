<?php
declare (strict_types = 1);

namespace Core\Mvc;

/**
 * Route
 *
 * @package Core\Mvc
 * @author Norbert Hanauer <norbert.hanauer@check24.de>
 * @copyright CHECK24 Vergleichsportal GmbH
 */
class Route
{
    /**
     * Path
     *
     * @var string
     */
    protected $path;

    /**
     * Controller
     *
     * @var string
     */
    protected $controllerName;

    /**
     * Action
     *
     * @var string
     */
    protected $actionName;

    /**
     * Is authentication needed
     *
     * @var bool
     */
    protected $auth;

    /**
     * Route Constructor
     *
     * @param array $routeConfig
     */
    public function __construct(array $routeConfig)
    {
        $this->path = $routeConfig['path'] ?? '';
        $this->controllerName = $routeConfig['controller'] ?? '';
        $this->actionName = $routeConfig['action'] ?? '';
        $this->auth = $routeConfig['auth'] ?? true;
    }

    /**
     * Returns path
     *
     * @return string
     */
    public function getPath(): string
    {
        return $this->path;
    }

    /**
     * Retunrs controller name
     *
     * @return string
     */
    public function getControllerName(): string
    {
        return $this->controllerName;
    }

    /**
     * Returns action name
     *
     * @return string
     */
    public function getActionName(): string
    {
        return $this->actionName;
    }

    /**
     * Tells if authentication is needed
     *
     * @return bool
     */
    public function needsAuthentication(): bool
    {
        return (bool)$this->auth;
    }
}
