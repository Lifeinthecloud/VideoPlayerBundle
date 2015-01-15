<?php

/*
 * This file is part of the VideoPlayerBundle package.
 *
 * (c) Life in the cloud <http://lifeinthecloud.fr/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Lifeinthecloud\VideoPlayerBundle\Validator;

use Lifeinthecloud\VideoPlayerBundle\Model\VideoInterface;
use Lifeinthecloud\VideoPlayerBundle\Model\VideoManagerInterface;
use Symfony\Component\Validator\ObjectInitializerInterface;

/**
 * Automatically updates the canonical fields before validation.
 *
 * @author Antoine DARCHE <antoine.darche@gmail.com>
 */
class Initializer implements ObjectInitializerInterface
{
    private $videoManager;

    /**
     * @param VideoManagerInterface $videoManager
     */
    public function __construct(VideoManagerInterface $videoManager)
    {
        $this->videoManager = $videoManager;
    }

    /**
     * @param $object
     */
    public function initialize($object)
    {
        if ($object instanceof VideoInterface) {
            $this->videoManager->updateCanonicalFields($object);
        }
    }
}