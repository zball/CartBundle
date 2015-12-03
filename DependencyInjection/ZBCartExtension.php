<?php

namespace ZB\CartBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class ZBCartExtension extends Extension
{
    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new Loader\XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.xml');
        
        $classes = $config['classes'];
        
        $container->setParameter('zb_cart.cart.entity', $classes['cart']['entity']);
        $container->setParameter('zb_cart.cart.manager.class', $classes['cart']['manager']);
        $container->setParameter('zb_cart.cart_item.entity', $classes['cart_item']['entity']);
        $container->setParameter('zb_cart.product.entity', $classes['product']['entity']);
        $container->setParameter('zb_cart.item_resolver.class', $classes['item_resolver']['model']);
        $container->setParameter('zb_cart.form.item_type', $classes['cart_item']['type']);
    }
}
