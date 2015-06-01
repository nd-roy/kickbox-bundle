<?php

namespace Andi\KickBoxBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files
 *
 * To learn more see {
 *   @link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class
 * }
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('andi_kick_box');

        $rootNode
            ->children()
                ->arrayNode('api_keys')
                ->useAttributeAsKey('name')
                ->requiresAtLeastOneElement()
                ->isRequired()
                ->info('API key list.')
                    ->prototype('array')
                        ->children()
                            ->scalarNode('token')
                                ->isRequired()
                                ->cannotBeEmpty()
                                ->info('The api token generated in kickbox.io.')
                            ->end()
                        ->end()
                    ->end()
                ->end()
                ->scalarNode('default_key')
                    ->info('The default key.')
                ->end()
            ->end()
        ;

        return $treeBuilder;
    }
}
