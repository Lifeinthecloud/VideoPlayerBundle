<?php

/*
 * This file is part of the VideoPlayerBundle package.
 *
 * (c) Life in the cloud <http://lifeinthecloud.fr/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Lifeinthecloud\VideoPlayerBundle\Doctrine;

use Doctrine\Common\Persistence\ObjectManager;
use Lifeinthecloud\VideoPlayerBundle\Model\VideoInterface;
use Lifeinthecloud\VideoPlayerBundle\Model\VideoManager as BaseVideoManager;
use Lifeinthecloud\VideoPlayerBundle\Util\CanonicalizerInterface;
use Symfony\Component\Security\Core\Encoder\EncoderFactoryInterface;

/**
 * @author Antoine DARCHE <antoine.darche@gmail.com>
 */
class VideoManager extends BaseVideoManager
{
    protected $objectManager;
    protected $class;
    protected $repository;

    /**
     * Constructor.
     *
     * @param EncoderFactoryInterface $encoderFactory
     * @param CanonicalizerInterface  $videoCanonicalizer
     * @param ObjectManager           $om
     * @param string                  $class
     */
    public function __construct(EncoderFactoryInterface $encoderFactory, ObjectManager $om, $class)
    {
        parent::__construct($encoderFactory);

        $this->objectManager = $om;
        $this->repository = $om->getRepository($class);

        $metadata = $om->getClassMetadata($class);
        $this->class = $metadata->getName();
    }

    /**
     * {@inheritDoc}
     */
    public function deleteVideo(VideoInterface $video)
    {
        $this->objectManager->remove($video);
        $this->objectManager->flush();
    }

    /**
     * {@inheritDoc}
     */
    public function getClass()
    {
        return $this->class;
    }

    /**
     * {@inheritDoc}
     */
    public function findVideoBy(array $criteria)
    {
        return $this->repository->findOneBy($criteria);
    }

    /**
     * {@inheritDoc}
     */
    public function findVideos()
    {
        return $this->repository->findAll();
    }

    /**
     * {@inheritDoc}
     */
    public function reloadVideo(VideoInterface $video)
    {
        $this->objectManager->refresh($video);
    }

    /**
     * Updates a video.
     *
     * @param VideoInterface $video
     * @param Boolean       $andFlush Whether to flush the changes (default true)
     */
    public function updateVideo(VideoInterface $video, $andFlush = true)
    {
        $this->updateCanonicalFields($video);
        $this->updatePassword($video);

        $this->objectManager->persist($video);
        if ($andFlush) {
            $this->objectManager->flush();
        }
    }
}
