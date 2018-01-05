<?php
declare (strict_types = 1);

namespace App\Authentication\Factory;

use App\Authentication\UserSessionAuthentication;
use Core\Manager\UserManager;
use Psr\Container\ContainerInterface;

/**
 * User Session Authentication Factory
 */
class UserSessionAuthenticationFactory
{
    /**
     * Creates and returns instance
     *
     * @param \Psr\Container\ContainerInterface $container
     * @return \App\Authentication\UserSessionAuthentication
     */
    public function __invoke(ContainerInterface $container): UserSessionAuthentication
    {
        return new UserSessionAuthentication(
            $container->get(UserManager::class)
        );
    }
}
