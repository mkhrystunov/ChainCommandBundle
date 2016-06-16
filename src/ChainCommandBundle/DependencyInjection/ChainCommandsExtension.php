<?php

namespace ChainCommandBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

class ChainCommandsExtension extends Extension
{
    /**
     * Loads a specific configuration.
     *
     * @param array $configs An array of configuration values
     * @param ContainerBuilder $container A ContainerBuilder instance
     *
     * @throws \InvalidArgumentException When provided tag is not defined in this extension
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $container->setParameter('chain_command.chains', $this->loadChainCommandsConfig($configs));
        $this->loadServices($container);
    }

    /**
     * @param array $configs
     * @return array
     */
    private function loadChainCommandsConfig(array $configs)
    {
        $configuration = new Configuration();
        return $this->processConfiguration($configuration, $configs);
    }

    /**
     * @param ContainerBuilder $container
     */
    private function loadServices(ContainerBuilder $container)
    {
        $loader = new YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yml');
    }
}
