<?php

namespace Matthias\ProjectBundle\DependencyInjection;

use Symfony\Component\Config\Definition\ConfigurationInterface;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;

class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();

        $rootNode = $treeBuilder->root('matthias_project');
        $rootNode
            ->addDefaultsIfNotSet()
            ->children()
                ->scalarNode('start_at')
                    ->isRequired()
                    ->validate()
                        ->ifTrue(function($value) {
                            return strtotime($value) === false;
                        })
                        ->thenInvalid('"start_at" should be parseable by strtotime()')
                    ->end()
                ->end()
                ->scalarNode('deadline')
                    ->isRequired()
                    ->validate()
                        ->ifTrue(function($value) {
                            return strtotime($value) === false;
                        })
                        ->thenInvalid('"deadline" should be parseable by strtotime()')
                    ->end()
                ->end()
            ->end()
        ;

        return $treeBuilder;
    }
}
