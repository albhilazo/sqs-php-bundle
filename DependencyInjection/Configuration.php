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
                ->arrayNode('queue')
                    ->children()
                        ->scalarNode('region')->end()
                        ->scalarNode('url')->end()
                    ->end()
                ->end()
            ->end()
        ;

        return $tree_builder;
    }

}
