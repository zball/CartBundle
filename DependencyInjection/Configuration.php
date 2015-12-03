<?php

namespace ZB\CartBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('zb_cart');

        $rootNode
            ->children()
                ->arrayNode('classes')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->arrayNode('cart')
                            ->addDefaultsIfNotSet()
                            ->children()
                                ->scalarNode('entity')->defaultValue('ZB\CartBundle\Entity\Cart')->end()
                                ->scalarNode('manager')->defaultValue('ZB\CartBundle\Model\CartManager')->end()
                            ->end()
                        ->end()
                        ->arrayNode('cart_item')
                            ->addDefaultsIfNotSet()
                            ->children()
                                ->scalarNode('entity')->defaultValue('ZB\CartBundle\Entity\CartItem')->end()
                                ->scalarNode('type')->defaultValue('ZB\CartBundle\Form\Type\CartItemType')->end()
                            ->end()
                        ->end()
                        ->arrayNode('product')
                            ->addDefaultsIfNotSet()
                            ->children()
                                ->scalarNode('entity')->defaultValue('ZB\CartBundle\Entity\Product')->end()
                            ->end()
                        ->end()
                        ->arrayNode('item_resolver')
                            ->addDefaultsIfNotSet()
                            ->children()
                                ->scalarNode('model')->defaultValue('ZB\CartBundle\Model\CartItemResolver')->end()
                            ->end()
                        ->end()
                    ->end()
                ->end()
            ->end()
        ;
        
        // Here you should define the parameters that are allowed to
        // configure your bundle. See the documentation linked above for
        // more information on that topic.
        
        return $treeBuilder;
    }
    
    
}
