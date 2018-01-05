<?php
declare (strict_types = 1);

namespace App\Controller\Factory;

use App\Controller\IndexController;
use Psr\Container\ContainerInterface;

/**
 * Index Controller Factory
 */
class IndexControllerFactory
{
    /**
     * Creates and returns instance
     *
     * @param \Psr\Container\ContainerInterface $container
     * @return \App\Controller\IndexController
     */
    public function __invoke(ContainerInterface $container): IndexController
    {
        return new IndexController();
    }
}
