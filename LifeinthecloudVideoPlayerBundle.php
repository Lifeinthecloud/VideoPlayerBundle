<?php

namespace LITC\VideoPlayerBundle;

use Doctrine\Bundle\DoctrineBundle\DependencyInjection\Compiler\DoctrineOrmMappingsPass;
use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;

/**
 * Abstract Video server Manager implementation which can be used as base class for your
 * concrete manager.
 *
 * @author Antoine DARCHE <antoine.darche@gmail.com>
 */
class LITCVideoPlayerBundle extends Bundle
{

    public function build(ContainerBuilder $container)
    {
        parent::build($container);
        $ormCompilerClass = 'Doctrine\Bundle\DoctrineBundle\DependencyInjection\Compiler\DoctrineOrmMappingsPass';
        if (class_exists($ormCompilerClass)) {
            $container->addCompilerPass($this->buildMappingCompilerPass());
        }
    }

    private function buildMappingCompilerPass()
    {
        $arguments = array(array(realpath(__DIR__ . '/Resources/config/doctrine')), '.orm.yml');
        $locator = new Definition('Doctrine\Common\Persistence\Mapping\Driver\DefaultFileLocator', $arguments);
        $driver = new Definition('Doctrine\ORM\Mapping\Driver\YmlDriver', array($locator));

        return new DoctrineOrmMappingsPass(
            $driver,
            array('LITC\VideoPlayerBundle'),
            array('litc_video_player.video_manager.default'),
            'LITCVideoPlayerBundle.orm_enabled'
        );
    }

}
