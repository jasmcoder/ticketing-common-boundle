<?php

declare(strict_types=1);

namespace xjasmx\TicketingCommonBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use xjasmx\TicketingCommonBundle\Service\Validator\ValidatorInterface;

class TicketingCommonExtension extends Extension
{
    public function load(array $configs, ContainerBuilder $container): void
    {
        $container->registerForAutoconfiguration(ValidatorInterface::class)
            ->addTag('xjasmx.ticket-common.validator');

        $loader = new YamlFileLoader(
            $container,
            new FileLocator(__DIR__ . '/../../config')
        );
        $loader->load('services.yaml');
    }
}