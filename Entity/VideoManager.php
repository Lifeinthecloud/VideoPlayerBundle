<?php

/*
 * This file is part of the VideoPlayerBundle package.
 *
 * (c) Life in the cloud <http://lifeinthecloud.fr/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace LITC\VideoPlayerBundle\Entity;

use Doctrine\ORM\EntityManager;
use LITC\VideoPlayerBundle\Doctrine\VideoManager as BaseVideoManager;
use LITC\VideoPlayerBundle\Util\CanonicalizerInterface;
use Symfony\Component\Security\Core\Encoder\EncoderFactoryInterface;

/**
 * BC class for people extending it in their bundle.
 */
class VideoManager extends BaseVideoManager
{
    protected $em;

    public function __construct(EncoderFactoryInterface $encoderFactory, CanonicalizerInterface $videonameCanonicalizer, CanonicalizerInterface $emailCanonicalizer, EntityManager $em, $class)
    {
        parent::__construct($encoderFactory, $videonameCanonicalizer, $emailCanonicalizer, $em, $class);

        $this->em = $em;
    }
}
