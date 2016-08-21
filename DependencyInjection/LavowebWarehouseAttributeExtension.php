<?php

namespace Lavoweb\Bundle\WarehouseAttributeBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;


/**
 * LavowebWarehouseAttributeExtension
 *
 * @author    Aurélien Lavorel <aurelien@lavoweb.net>
 */
class LavowebWarehouseAttributeExtension extends Extension
{

    /**
     * Loads a specific configuration.
     *
     * @param array            $config    An array of configuration values
     * @param ContainerBuilder $container A ContainerBuilder instance
     *
     * @throws \InvalidArgumentException When provided tag is not defined in this extension
     *
     * @api
     */
    public function load(array $config, ContainerBuilder $container)
    {
        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('attribute_types.yml');
        $loader->load('providers.yml');
        $loader->load('array_converters.yml');
        $loader->load('comparators.yml');
        $loader->load('updaters.yml');
        $loader->load('validators.yml');
        $loader->load('denormalizers.yml');
        $loader->load('readers.yml');
    }
}
