<?php

namespace Lifeinthecloud\VideoPlayerBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Lifeinthecloud\VideoPlayerBundle\DependencyInjection\Compiler\ValidationPass;
use Lifeinthecloud\VideoPlayerBundle\DependencyInjection\Compiler\RegisterMappingsPass;

/**
 * Abstract Video server Manager implementation which can be used as base class for your
 * concrete manager.
 *
 * @author Antoine DARCHE <antoine.darche@gmail.com>
 */
class LifeinthecloudVideoPlayerBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        parent::build($container);
        $container->addCompilerPass(new ValidationPass());

        $this->addRegisterMappingsPass($container);
    }

    /**
     * @param ContainerBuilder $container
     */
    private function addRegisterMappingsPass(ContainerBuilder $container)
    {
        // the base class is only available since symfony 2.3
        $symfonyVersion = class_exists('Symfony\Bridge\Doctrine\DependencyInjection\CompilerPass\RegisterMappingsPass');
        $mappings = array(
            realpath(__DIR__ . '/Resources/config/doctrine/model') => 'Lifeinthecloud\VideoPlayerBundle\Model',
        );
        if ($symfonyVersion && class_exists('Doctrine\Bundle\DoctrineBundle\DependencyInjection\Compiler\DoctrineOrmMappingsPass')) {
            $container->addCompilerPass(DoctrineOrmMappingsPass::createXmlMappingDriver($mappings, array('lifeinthecloud_video_player.model_manager_name'), 'lifeinthecloud_video_player.backend_type_orm'));
        } else {
            $container->addCompilerPass(RegisterMappingsPass::createOrmMappingDriver($mappings));
        }
    }
}
