<?php

namespace Matthias\ProjectBundle\DependencyInjection;

use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;
use Symfony\Component\Config\FileLocator;

class MatthiasProjectExtension extends Extension
{
    public function load(array $config, ContainerBuilder $container)
    {
        $locator = new FileLocator(__DIR__.'/../Resources/config');
        $loader = new XmlFileLoader($container, $locator);
        $loader->load('services.xml');

        $processedConfig = $this->processConfiguration(new Configuration(), $config);

        $container->setParameter(
            'matthias_project.start_at',
            $processedConfig['start_at']
        );
        $container->setParameter(
            'matthias_project.deadline',
            $processedConfig['deadline']
        );
    }
}
