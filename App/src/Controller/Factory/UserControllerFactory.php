<?php
declare (strict_types = 1);

namespace App\Controller\Factory;

use App\Controller\UserController;
use Core\Manager\UserManager;
use Psr\Container\ContainerInterface;

/**
 * User Controller Factory
 */
class UserControllerFactory
{
    /**
     * Creates and returns instance
     *
     * @param \Psr\Container\ContainerInterface $container
     * @return \App\Controller\UserController
     */
    public function __invoke(ContainerInterface $container): UserController
    {
        return new UserController(
            $container->get(UserManager::class)
        );
    }
}
