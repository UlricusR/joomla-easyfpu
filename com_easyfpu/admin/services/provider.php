<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_easyfpu
 *
 * @copyright   Copyright (C) 2019 Ulrich Rueth. All rights reserved.
 * @license     GNU General Public License version 3 or later
 */

// No direct access
defined('_JEXEC') or die;

// Imports
use Joomla\CMS\Component\Router\RouterFactoryInterface;
use Joomla\CMS\Dispatcher\ComponentDispatcherFactoryInterface;
use Joomla\CMS\Extension\ComponentInterface;
use Joomla\CMS\Extension\Service\Provider\CategoryFactory;
use Joomla\CMS\Extension\Service\Provider\ComponentDispatcherFactory;
use Joomla\CMS\Extension\Service\Provider\MVCFactory;
use Joomla\CMS\Extension\Service\Provider\RouterFactory;
use Joomla\CMS\MVC\Factory\MVCFactoryInterface;
use Joomla\DI\Container;
use Joomla\DI\ServiceProviderInterface;
use RuethInfo\Component\Easyfpu\Administrator\Extension\EasyfpuComponent;
use Joomla\CMS\HTML\Registry;

/**
 * The Easyfpu service provider.
 *
 * @since  4.0.0
 */
return new class implements ServiceProviderInterface
{
    /**
     * Registers the service provider with a DI container.
     *
     * @param   Container  $container  The DI container.
     *
     * @return  void
     *
     * @since   4.0.0
     */
    public function register(Container $container)
    {
        $container->registerServiceProvider(new CategoryFactory('\\RuethInfo\\Component\\Easyfpu'));
        $container->registerServiceProvider(new MVCFactory('\\RuethInfo\\Component\\Easyfpu'));
        $container->registerServiceProvider(new ComponentDispatcherFactory('\\RuethInfo\\Component\\Easyfpu'));
        $container->registerServiceProvider(new RouterFactory('\\RuethInfo\\Component\\Easyfpu'));
        $container->set(
            ComponentInterface::class,
            function (Container $container)
            {
                $component = new EasyfpuComponent($container->get(ComponentDispatcherFactoryInterface::class));
                
                $component->setRegistry($container->get(Registry::class));
                $component->setMVCFactory($container->get(MVCFactoryInterface::class));
                // $component->setCategoryFactory($container->get(CategoryFactoryInterface::class));
                $component->setRouterFactory($container->get(RouterFactoryInterface::class));
                
                return $component;
            }
        );
    }
};
