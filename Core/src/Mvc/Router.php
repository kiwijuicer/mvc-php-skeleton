<?php
declare (strict_types = 1);

namespace Core\Mvc;

use Core\Entity\User;
use Core\Mvc\Exception\HttpNotFoundException;

/**
 * Router
 *
 * @package Core\Mvc
 * @author Norbert Hanauer <norbert.hanauer@check24.de>
 * @copyright CHECK24 Vergleichsportal GmbH
 */
class Router
{
    /**
     * Template
     *
     * @var string
     */
    protected $template;

    /**
     * Matches and returns route against request
     *
     * @param \Core\Mvc\Request $request
     * @return \Core\Mvc\Route
     * @throws \Core\Mvc\Exception\HttpNotFoundException
     */
    public function match(Request $request): Route
    {
        $routes = Application::getConfig()['routes'] ?? [];

        foreach ($routes as $routeConfig) {

            $route = new Route($routeConfig);
            $path = str_replace('?' . $request->getServer()['QUERY_STRING'], '', $request->getServer()['REQUEST_URI']);

            if ($route->getPath() === $path) {
                return $route;
            }
        }

        throw new HttpNotFoundException('Given request did not match any route');
    }

    /**
     * Routes to given route
     *
     * @param \Core\Mvc\Route $route
     * @return void
     */
    public function routeTo(Route $route): void
    {
        // Check for authentication
        if (!$this->isAuthenticated($route)) {
            self::redirect('/login', [
                'old-uri' => $route->getPath()
            ]);
        }

        /** @var \App\Controller\AbstractController $controller */
        $controller = Application::getDependencyManager()->get($route->getControllerName());

        $controller->setRequest(Application::getDependencyManager()->get(Request::class));

        $explodedAction = explode('-', $route->getActionName());

        $actionName = '';

        foreach ($explodedAction as $actionPart) {
            $actionName .= ($actionName === '') ? $actionPart : ucfirst($actionPart);
        }

        $actionName .= 'Action';

        $viewParams = $controller->{$actionName}();

        if ($this->template !== null) {
            $template = $this->template;
        } else {
            $explodedControllerName = explode('\\', $route->getControllerName());
            $directory = mb_strtolower(str_replace('Controller', '', end($explodedControllerName)));
            $template = $directory . '/' . $route->getActionName() . '.phtml';
        }

        $view = new View($template, $viewParams);

        $view->show();
    }

    /**
     * Overrides the template
     *
     * @param string $template
     * @return void
     */
    public function setTemplate(string $template): void
    {
        $this->template = $template;
    }

    /**
     * Redirects to url
     *
     * @param string $uri
     * @param array|null $params
     * @return void
     */
    public static function redirect(string $uri, array $params = null): void
    {
        $url = Application::getConfig()['base-url'] . $uri . ($params !== null ? '?' . http_build_query($params) : '');
        header('Location: ' . $url);
        exit();
    }

    /**
     * Checks for authentication
     *
     * @param \Core\Mvc\Route $route
     * @return bool
     */
    public function isAuthenticated(Route $route): bool
    {
        if ($route->needsAuthentication()) {
            return array_key_exists('user', $_SESSION) && $_SESSION['user'] instanceof User;
        }

        return true;
    }
}
