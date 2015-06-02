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
    const DEFAULT_ENDPOINT = 'https://api.kickbox.io/v2/verify';

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
                            ->scalarNode('key')
                                ->isRequired()
                                ->cannotBeEmpty()
                                ->info('The api key generated in kickbox.io.')
                            ->end()
                        ->end()
                    ->end()
                ->end()
                ->scalarNode('default_api_name')
                    ->info('The default API name.')
                ->end()
                ->scalarNode('endpoint')
                    ->info('The endpoint of the kickbox API.')
                    ->cannotBeEmpty()
                    ->defaultValue(self::DEFAULT_ENDPOINT)
                ->end()
            ->end()
        ;

        return $treeBuilder;
    }
}
