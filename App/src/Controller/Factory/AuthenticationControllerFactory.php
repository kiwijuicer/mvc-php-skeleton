<?php
declare (strict_types = 1);

namespace App\Controller\Factory;

use App\Controller\AuthenticationController;
use Core\Manager\UserManager;
use Psr\Container\ContainerInterface;

/**
 * Authentication Controller Factory
 */
class AuthenticationControllerFactory
{
    /**
     * Creates and returns instance
     *
     * @param \Psr\Container\ContainerInterface $container
     * @return \App\Controller\AuthenticationController
     */
    public function __invoke(ContainerInterface $container): AuthenticationController
    {
        return new AuthenticationController(
            $container->get(UserManager::class)
        );
    }
}
