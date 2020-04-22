<?php

namespace App\Handler;

use Doctrine\ORM\EntityManager;
use Interop\Container\ContainerInterface;
use Zend\Expressive\Template\TemplateRendererInterface;

class ProductsListHandlerFactory
{
    public function __invoke(ContainerInterface $container)
    {
        $template = $container->get(TemplateRendererInterface::class);
        $em = $container->get(EntityManager::class);

        return new ProductsListHandler($template, $em);
    }
}
