<?php

/*
 * This file is part of the FOSUserBundle package.
 *
 * (c) FriendsOfSymfony <http://friendsofsymfony.github.com/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Lifeinthecloud\VideoPlayerBundle\Doctrine;

use Doctrine\Common\Persistence\ObjectManager;
use Lifeinthecloud\VideoPlayerBundle\Model\VideoServerInterface;
use Lifeinthecloud\VideoPlayerBundle\Model\VideoServerManager as BaseVideoServerManager;

/**
 * @author Antoine DARCHE <antoine.darche@gmail.com>
 */
class VideoServerManager extends BaseVideoServerManager
{
    protected $objectManager;
    protected $class;
    protected $repository;

    public function __construct(ObjectManager $om, $class)
    {
        $this->objectManager = $om;
        $this->repository = $om->getRepository($class);

        $metadata = $om->getClassMetadata($class);
        $this->class = $metadata->getName();
    }

    /**
     * {@inheritDoc}
     */
    public function deleteVideoServer(VideoServerInterface $videoServer)
    {
        $this->objectManager->remove($videoServer);
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
    public function findVideoServerBy(array $criteria)
    {
        return $this->repository->findOneBy($criteria);
    }

    /**
     * {@inheritDoc}
     */
    public function findVideoServers()
    {
        return $this->repository->findAll();
    }

    /**
     * Updates a video server
     *
     * @param VideoServerInterface $videoServer
     * @param Boolean        $andFlush Whether to flush the changes (default true)
     */
    public function updateVideoServer(VideoServerInterface $videoServer, $andFlush = true)
    {
        $this->objectManager->persist($videoServer);
        if ($andFlush) {
            $this->objectManager->flush();
        }
    }
}
