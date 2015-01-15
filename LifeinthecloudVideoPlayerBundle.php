<?php

namespace Lifeinthecloud\VideoPlayerBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;

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
    }
}
