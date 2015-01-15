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
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\Config\Resource\FileResource;

/**
 * Registers the additional validators according to the storage
 *
 * @author Antoine DARCHE <antoine.darche@gmail.com>
 */
class ValidationPass implements CompilerPassInterface
{
    /**
     * {@inheritDoc}
     */
    public function process(ContainerBuilder $container)
    {
        if (!$container->hasParameter('lifeinthecloud_video_player.storage')) {
            return;
        }
        $storage = $container->getParameter('lifeinthecloud_video_player.storage');
        if ('custom' === $storage) {
            return;
        }
        $validationFile = __DIR__ . '/../../Resources/config/validation/' . $storage . '.xml';
        if ($container->hasDefinition('validator.builder')) {
            // Symfony 2.5+
            $container->getDefinition('validator.builder')
                ->addMethodCall('addXmlMapping', array($validationFile));
            return;
        }
        // Old method of loading validation
        if (!$container->hasParameter('validator.mapping.loader.yml_files_loader.mapping_files')) {
            return;
        }
        $files = $container->getParameter('validator.mapping.loader.yml_files_loader.mapping_files');
        if (is_file($validationFile)) {
            $files[] = realpath($validationFile);
            $container->addResource(new FileResource($validationFile));
        }
        $container->setParameter('validator.mapping.loader.yml_files_loader.mapping_files', $files);
    }
}
