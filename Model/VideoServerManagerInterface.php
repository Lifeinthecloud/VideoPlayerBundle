<?php

/*
 * This file is part of the VideoPlayerBundle package.
 *
 * (c) Life in the cloud <http://lifeinthecloud.fr/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Lifeinthecloud\VideoPlayerBundle\Model;

/**
 * Interface to be implemented by video server managers. This adds an additional level
 * of abstraction between your application, and the actual repository.
 *
 * All changes to video server should happen through this interface.
 *
 * @author Antoine DARCHE <antoine.darche@gmail.com>
 */
interface VideoServerManagerInterface
{
    /**
     * Returns an empty video server instance.
     *
     * @param string $name
     *
     * @return VideoServerInterface
     */
    public function createVideoServer($name);

    /**
     * Deletes a video server.
     *
     * @param VideoServerInterface $videoServer
     *
     * @return void
     */
    public function deleteVideoServer(VideoServerInterface $videoServer);

    /**
     * Finds one video server by the given criteria.
     *
     * @param array $criteria
     *
     * @return VideoServerInterface
     */
    public function findVideoServerBy(array $criteria);

    /**
     * Finds a video server by name.
     *
     * @param string $name
     *
     * @return VideoServerInterface
     */
    public function findVideoServerByName($name);

    /**
     * Returns a collection with all video server instances.
     *
     * @return \Traversable
     */
    public function findVideoServers();

    /**
     * Returns the video server's fully qualified class name.
     *
     * @return string
     */
    public function getClass();

    /**
     * Updates a video server.
     *
     * @param VideoServerInterface $videoServer
     *
     * @return void
     */
    public function updateVideoServer(VideoServerInterface $videoServer);
}
