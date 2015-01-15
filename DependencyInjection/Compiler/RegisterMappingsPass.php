<?php

/*
 * This file is part of the VideoPlayerBundle package.
 *
 * (c) Life in the cloud <http://lifeinthecloud.fr/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Lifeinthecloud\VideoPlayerBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\Exception\ParameterNotFoundException;

/**
 * Forward compatibility class in case FOSUserBundle is used with older
 * versions of Symfony2 or the doctrine bundles that do not provide the
 * register mappings compiler pass yet.
 *
 * @deprecated Compatibility class to make the bundle work with Symfony < 2.3.
 * To be removed when this bundle drops support for Symfony < 2.3
 *
 * @author Antoine DARCHE <antoine.darche@gmail.com>
 */
class RegisterMappingsPass implements CompilerPassInterface
{
    private $driver;
    private $driverPattern;
    private $namespaces;
    private $enabledParameter;
    private $fallbackManagerParameter;

    public function __construct($driver, $driverPattern, $namespaces, $enabledParameter, $fallbackManagerParameter)
    {
        $this->driver = $driver;
        $this->driverPattern = $driverPattern;
        $this->namespaces = $namespaces;
        $this->enabledParameter = $enabledParameter;
        $this->fallbackManagerParameter = $fallbackManagerParameter;
    }
    /**
     * Register mappings with the metadata drivers.
     *
     * @param ContainerBuilder $container
     */
    public function process(ContainerBuilder $container)
    {
        if (!$container->hasParameter($this->enabledParameter)) {
            return;
        }
        $chainDriverDefService = $this->getChainDriverServiceName($container);
        $chainDriverDef = $container->getDefinition($chainDriverDefService);
        foreach ($this->namespaces as $namespace) {
            $chainDriverDef->addMethodCall('addDriver', array($this->driver, $namespace));
        }
    }

    /**
     * @param ContainerBuilder $container
     * @return string
     * @throws ParameterNotFoundException
     */
    protected function getChainDriverServiceName(ContainerBuilder $container)
    {
        foreach (array('lifeinthecloud_video_player.model_manager_name', $this->fallbackManagerParameter) as $param) {
            if ($container->hasParameter($param)) {
                $name = $container->getParameter($param);
                if ($name) {
                    return sprintf($this->driverPattern, $name);
                }
            }
        }
        throw new ParameterNotFoundException('None of the managerParameters resulted in a valid name');
    }

    /**
     * @param array $mappings
     * @return RegisterMappingsPass
     */
    public static function createOrmMappingDriver(array $mappings)
    {
        $arguments = array($mappings, '.orm.yml');
        $locator = new Definition('Doctrine\Common\Persistence\Mapping\Driver\SymfonyFileLocator', $arguments);
        $driver = new Definition('Doctrine\ORM\Mapping\Driver\YamlDriver', array($locator));
        return new RegisterMappingsPass($driver, 'doctrine.orm.%s_metadata_driver', $mappings, 'lifeinthecloud_video_player.backend_type_orm', 'doctrine.default_entity_manager');
    }
}
