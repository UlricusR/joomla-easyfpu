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
use RuethInfo\Component\EasyFPU\Administrator\Extension\EasyFPUComponent;
use Joomla\CMS\HTML\Registry;

/**
 * The EasyFPU service provider.
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
        $container->registerServiceProvider(new CategoryFactory('\\RuethInfo\\Component\\EasyFPU'));
        $container->registerServiceProvider(new MVCFactory('\\RuethInfo\\Component\\EasyFPU'));
        $container->registerServiceProvider(new ComponentDispatcherFactory('\\RuethInfo\\Component\\EasyFPU'));
        $container->registerServiceProvider(new RouterFactory('\\RuethInfo\\Component\\EasyFPU'));
        $container->set(
            ComponentInterface::class,
            function (Container $container)
            {
                $component = new EasyFPUComponent($container->get(ComponentDispatcherFactoryInterface::class));
                
                $component->setRegistry($container->get(Registry::class));
                $component->setMVCFactory($container->get(MVCFactoryInterface::class));
                // $component->setCategoryFactory($container->get(CategoryFactoryInterface::class));
                $component->setRouterFactory($container->get(RouterFactoryInterface::class));
                
                return $component;
            }
        );
    }
};
