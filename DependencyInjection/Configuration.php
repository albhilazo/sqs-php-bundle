<?php

namespace SqsPhpBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;




class Configuration implements ConfigurationInterface
{

    public function getConfigTreeBuilder()
    {
        $tree_builder = new TreeBuilder();
        $root_node = $tree_builder->root('sqs_php');

        $root_node
            ->children()
                ->arrayNode('queues')
                    ->prototype('array')
                        ->children()
                            ->scalarNode('region')->end()
                            ->scalarNode('url')->end()
                            ->arrayNode('worker')
                                ->prototype('scalar')->end()
                            ->end()
                        ->end()
                    ->end()
                ->end()
            ->end()
        ;

        return $tree_builder;
    }

}
