<?php

/*
 * This file is part of the Kickbox Bundle.
 *
 * (c) Abdoul Ndiaye <abdoul.nd@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Andi\KickBoxBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class AndiKickBoxExtension extends Extension
{
    const DEFAULT_CLIENT_SERVICE_NAME = 'kickbox_client';

    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $loader = new Loader\XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.xml');

        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $this->processClientDefinitions($container, $config);
        $this->createDefaultClientAlias($container, $config);
    }

    /**
     * Process and create the kickbox client services.
     *
     * @param ContainerBuilder $container A ContainerBuilder instance
     * @param array $config               The configuration of the kickbox bundle.
     */
    protected function processClientDefinitions(ContainerBuilder $container, array $config)
    {
        $clientClass = $container->getParameter('kickbox.http.client.class');
        $endPoint    = $config['endpoint'];
        $apiKeys     = $config['api_keys'];

        foreach ($apiKeys as $name => $node) {
            $clientDefinition = new Definition($clientClass);
            $clientDefinition->addArgument($endPoint);
            $clientDefinition->addArgument($node['key']);

            $container->setDefinition($this->getClientServiceName($name), $clientDefinition);
        }
    }

    /**
     * Create an alias for the default service definition.
     *
     * @param ContainerBuilder $container A ContainerBuilder instance
     * @param array $config               The configuration of the kickbox bundle.
     */
    protected function createDefaultClientAlias(ContainerBuilder $container, array $config)
    {
        $apiKeys     = $config['api_keys'];
        $defaultName = isset($config['default_api_name']) ? $config['default_api_name'] : null;

        if (null !== $defaultName && array_key_exists($defaultName, $apiKeys)) {
            $defaultClientReference = $defaultName;
        } else {
            $defaultClientReference = array_keys($apiKeys)[0];
        }
        $container->setAlias(static::DEFAULT_CLIENT_SERVICE_NAME, $this->getClientServiceName($defaultClientReference));
    }

    /**
     * Returns the name of a client service according to a given name.
     *
     * @param  string $name
     * @return string
     */
    protected function getClientServiceName($name)
    {
        return static::DEFAULT_CLIENT_SERVICE_NAME . '.' . $name;
    }
}
